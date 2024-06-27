/**
 * @license Copyright (c) CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.plugins.add("wordcount", {
    lang: "ca,de,el,en,es,fr,hr,it,jp,nl,no,pl,pt-br,ru,sv,tr", // %REMOVE_LINE_CORE%
    version: 1.12,
    requires: 'htmlwriter',
    init: function (editor) {
        var defaultFormat = "",
            intervalId,
            lastWordCount = -1,
            lastCharCount = -1,
            limitReachedNotified = false,
            limitRestoredNotified = false,
            snapShot = editor.getSnapshot();

        var dispatchEvent = function (type, currentLength, maxLength) {
            if (typeof document.dispatchEvent == 'undefined') {
                return;
            }

            type = 'ckeditor.wordcount.' + type;

            var cEvent;
            var eventInitDict = {
                bubbles: false,
                cancelable: true,
                detail: {
                    currentLength: currentLength,
                    maxLength: maxLength
                }
            };

            try {
                cEvent = new CustomEvent(type, eventInitDict);
            } catch (o_O) {
                cEvent = document.createEvent('CustomEvent');
                cEvent.initCustomEvent(
                    type,
                    eventInitDict.bubbles,
                    eventInitDict.cancelable,
                    eventInitDict.detail
                );
            }

            document.dispatchEvent(cEvent);
        };

        // Default Config
        var defaultConfig = {
            showParagraphs: true,
            showWordCount: true,
            showCharCount: false,
            countSpacesAsChars: false,
            countHTML: false,
            hardLimit: true,

            //MAXLENGTH Properties
            maxWordCount: -1,
            maxCharCount: -1,

            //DisAllowed functions
            wordCountGreaterThanMaxLengthEvent: function (currentLength, maxLength) {
                dispatchEvent('wordCountGreaterThanMaxLengthEvent', currentLength, maxLength);
            },
            charCountGreaterThanMaxLengthEvent: function (currentLength, maxLength) {
                dispatchEvent('charCountGreaterThanMaxLengthEvent', currentLength, maxLength);
            },

            //Allowed Functions
            wordCountLessThanMaxLengthEvent: function (currentLength, maxLength) {
                dispatchEvent('wordCountLessThanMaxLengthEvent', currentLength, maxLength);
            },
            charCountLessThanMaxLengthEvent: function (currentLength, maxLength) {
                dispatchEvent('charCountLessThanMaxLengthEvent', currentLength, maxLength);
            }
        };

        // Get Config & Lang
        var config = CKEDITOR.tools.extend(defaultConfig, editor.config.wordcount || {}, true);

        if (config.showParagraphs) {
            defaultFormat += editor.lang.wordcount.Paragraphs + " %paragraphs%";
        }

        if (config.showParagraphs && (config.showWordCount || config.showCharCount)) {
            defaultFormat += ", ";
        }

        if (config.showWordCount) {
            defaultFormat += editor.lang.wordcount.WordCount + " %wordCount%";
            if (config.maxWordCount > -1) {
                defaultFormat += "/" + config.maxWordCount;
            }
        }

        if (config.showCharCount && config.showWordCount) {
            defaultFormat += ", ";
        }

        if (config.showCharCount) {
            var charLabel = editor.lang.wordcount[config.countHTML ? "CharCountWithHTML" : "CharCount"];

            defaultFormat += charLabel + " %charCount%";
            if (config.maxCharCount > -1) {
                defaultFormat += "/" + config.maxCharCount;
            }
        }

        var format = defaultFormat;

        if (config.loadCss === undefined || config.loadCss) {
          CKEDITOR.document.appendStyleSheet(this.path + "css/wordcount.css");
        }

        function counterId(editorInstance) {
            return "cke_wordcount_" + editorInstance.name;
        }

        function counterElement(editorInstance) {
            return document.getElementById(counterId(editorInstance));
        }

        function strip(html) {
            var tmp = document.createElement("div");
            tmp.innerHTML = html;

            if (tmp.textContent == "" && typeof tmp.innerText == "undefined") {
                return "";
            }

            return tmp.textContent || tmp.innerText;
        }

        function countCharacters(text) {
            if (config.countHTML) {
                return (text.length);
            } else {
                var normalizedText;

                // strip body tags
                if (editor.config.fullPage) {
                    var i = text.search(new RegExp("<body>", "i"));
                    if (i != -1) {
                        var j = text.search(new RegExp("</body>", "i"));
                        text = text.substring(i + 6, j);
                    }

                }

                normalizedText = text;

                if (!config.countSpacesAsChars) {
                    normalizedText = text.
                        replace(/\s/g, "").
                        replace(/&nbsp;/g, "");
                }

                normalizedText = normalizedText.
                    replace(/(\r\n|\n|\r)/gm, "").
                    replace(/&nbsp;/gi, " ");

                normalizedText = strip(normalizedText).replace(/^([\t\r\n]*)$/, "");

                return(normalizedText.length);
            }
        }

        function countParagraphs(text) {
            return (text.replace(/&nbsp;/g, " ").replace(/(<([^>]+)>)/ig, "").replace(/^\s*$[\n\r]{1,}/gm, "++").split("++").length);
        }

        function countWords(text) {
            var normalizedText = text.
                replace(/(\r\n|\n|\r)/gm, " ").
                replace(/^\s+|\s+$/g, "").
                replace("&nbsp;", " ");

            normalizedText = strip(normalizedText);

            var words = normalizedText.split(/\s+/);

            for (var wordIndex = words.length - 1; wordIndex >= 0; wordIndex--) {
                if (words[wordIndex].match(/^([\s\t\r\n]*)$/)) {
                    words.splice(wordIndex, 1);
                }
            }

            return (words.length);
        }

		//2018-01-24 최종화 추가
		function checkbyte(text,Byte){
			var clearChk=true;
			var limitByte = !Byte?80:Byte; //바이트의 최대크기, limitByte 를 초과할 수 없슴

            var normalizedText = text.
                replace(/(\r\n|\n|\r)/gm, " ").
                replace(/^\s+|\s+$/g, "").
                replace("&nbsp;", " ");

			var totalByte = 0;
			var message = strip(normalizedText);

			for(var i =0; i < message.length; i++) {
				var currentByte = message.charCodeAt(i);
				if($.trim(message.charAt(i)) == "") totalByte += 1; 
				else{
					if(currentByte > 128) totalByte += 2; 
					else totalByte++;
				}
			}

			if(totalByte > limitByte) {
				return {"byte":totalByte,"text":text};
			}

            return {"byte":totalByte,"text":text};
		}

		//2018-01-25 테이블 바이트수 체크
		function checktablebyte(text,Byte){
			var clearChk=true;
			var limitByte = !Byte?80:Byte; //바이트의 최대크기, limitByte 를 초과할 수 없슴
			var totalByte = 0;
			var html  = $.parseHTML( text ), $table = $(html).filter('table'),row_cnt=0;
			
			var $etc_obj = $(html);
			var etc_byte = 0;
			$.each( html, function( i, el ) {
				if(el.nodeName=='#text'){
					var etc_byteText = checkbyte(el.textContent,9999);
					etc_byte += etc_byteText['byte'];
				}else{
					$(el).find('tr').each(function(i){
						row_cnt++;
					});

					//테이블 제외
					$new_obj = $(el).find('table').remove();

					//console.log($new_obj,$new_obj.find('p,span,font,b,strong').text());

					var etc_byteText = checkbyte($new_obj.find('p,span,font,b,strong').text(),9999);
					etc_byte += etc_byteText['byte'];
				}
			});

			totalByte = row_cnt * 80;

			//console.log(totalByte,etc_byte);
			if(etc_byte>0){
				totalByte = totalByte+etc_byte;
			}

			if(totalByte > limitByte) {
				return {"byte":totalByte,"text":text};
			}

            return {"byte":totalByte,"text":text};
		}

        function limitReached(editorInstance, notify) {
            limitReachedNotified = true;
            limitRestoredNotified = false;

            if (config.hardLimit) {
                editorInstance.loadSnapshot(snapShot);
                // lock editor
                editorInstance.config.Locked = 1;
            }

            if (!notify) {
                counterElement(editorInstance).className = "cke_path_item cke_wordcountLimitReached";
                editorInstance.fire("limitReached", {}, editor);
            }

        }

        function limitRestored(editorInstance) {
            limitRestoredNotified = true;
            limitReachedNotified = false;
            editorInstance.config.Locked = 0;
            snapShot = editor.getSnapshot();

            counterElement(editorInstance).className = "cke_path_item";
        }
		
		
		var data1 = data2 = data3 = data4 = data5 = 0;
        function updateCounter(editorInstance) {
            var paragraphs = 0,
                wordCount = 0,
                charCount = 0,
                text;
            var maxByte = editorInstance.filter.editor.config.maxByte,check_mode = editorInstance.filter.editor.config.check_mode;
			

            if (text = editorInstance.getData()) {
                if (config.showCharCount) {
                    charCount = countCharacters(text);
                }

                if (config.showParagraphs) {
                    paragraphs = countParagraphs(text);
                }

                if (config.showWordCount) {
                    wordCount = countWords(text);
                }

                if (config.showbyteCount) {
                    byteCount = checkbyte(text,maxByte);
                    bytettt = byteCount.byte;
                }
            }

			//var html = format.replace("%wordCount%", wordCount).replace("%charCount%", charCount).replace("%paragraphs%", paragraphs).replace("%bytettt%", bytettt);
			var html = format.replace("%wordCount%", wordCount).replace("%charCount%", charCount).replace("%paragraphs%", paragraphs);


           if (config.showbyteCount) {
			    if(check_mode == 'table'){
					var tset1 = checktablebyte(editorInstance.getData(),maxByte);
				}else{
					var tset1 = checkbyte(editorInstance.getData(),maxByte);
				}
				if(tset1.byte > maxByte){
					alert('Case should NOT exceed '+maxByte+' byte.');

					html = tset1.text.substring(0, maxByte);
				}
				$('#'+editorInstance.name+'_cnt').val(tset1.byte);

				//VIEW객체가 있을경우에만 실행
				if($('#'+editorInstance.name+'_view').length){
					$('#'+editorInstance.name+'_view').html(tset1.byte);
				}
				
				//total을 보여줘야하는 객체가 있을때에만 실행
				if($('#byte_table').length){
					//2018-02-20 실시간 연동을 위한 추가.
					var total_byte = 0;
					$('#byte_table').find('strong[id$="_view"]').each(function(i){
						var tbyte = $(this).text();
						total_byte += tbyte*1;
					});
					$('#byte_table').find('#total_byte').html(total_byte);
				}
				
				//바이트로 임의변경
				counterElement(editorInstance).innerHTML = "Byte : "+tset1.byte;

				//editorInstance.plugins.bytecount.charCount = bytettt;
		   }else{
				data1 = countWords(CKEDITOR.instances.purpose.getData());
				//data2 = countWords(CKEDITOR.instances.method.getData());
				//data3 = countWords(CKEDITOR.instances.result.getData());
				//data4 = countWords(CKEDITOR.instances.conclusion.getData());
			
			
				var tot_data = data1;
		
				if(tot_data>500){
					alert('Case should NOT exceed 500 words.')
					new_data2 = tot_data;
				}else{
					new_data2 = tot_data;
				}
	
				//$("#remLen_max").val(tot_data);
				//$("#remLen").html(new_data2);
				$("#words_cnt5").val(new_data2);

				editorInstance.plugins.wordcount.wordCount = wordCount;
				editorInstance.plugins.wordcount.charCount = charCount;

				if (CKEDITOR.env.gecko) {
					counterElement(editorInstance).innerHTML = html;
				} else {
					counterElement(editorInstance).innerText = html;
				}

				if (charCount == lastCharCount && wordCount == lastWordCount) {
					return true;
				}

				//If the limit is already over, allow the deletion of characters/words. Otherwise,
				//the user would have to delete at one go the number of offending characters
				var deltaWord = wordCount - lastWordCount;
				var deltaChar = charCount - lastCharCount;

				lastWordCount = wordCount;
				lastCharCount = charCount;

				if (lastWordCount == -1) {
					lastWordCount = wordCount;
				}
				if (lastCharCount == -1) {
					lastCharCount = charCount;
				}

				// Check for word limit and/or char limit
				if ((config.maxWordCount > -1 && wordCount > config.maxWordCount && deltaWord > 0) ||
					(config.maxCharCount > -1 && charCount > config.maxCharCount && deltaChar > 0)) {

					limitReached(editorInstance, limitReachedNotified);
				} else if (!limitRestoredNotified &&
							(config.maxWordCount == -1 || wordCount < config.maxWordCount) &&
							(config.maxCharCount == -1 || charCount < config.maxCharCount)) {

					limitRestored(editorInstance);
				} else {
					snapShot = editorInstance.getSnapshot();
				}

				// Fire Custom Events
				if (config.charCountGreaterThanMaxLengthEvent && config.charCountLessThanMaxLengthEvent) {
					if (charCount > config.maxCharCount && config.maxCharCount > -1) {
						config.charCountGreaterThanMaxLengthEvent(charCount, config.maxCharCount);
					} else {
						config.charCountLessThanMaxLengthEvent(charCount, config.maxCharCount);
					}
				}

				if (config.wordCountGreaterThanMaxLengthEvent && config.wordCountLessThanMaxLengthEvent) {
					if (wordCount > config.maxWordCount && config.maxWordCount > -1) {
						config.wordCountGreaterThanMaxLengthEvent(wordCount, config.maxWordCount);

					} else {
						config.wordCountLessThanMaxLengthEvent(wordCount, config.maxWordCount);
					}
				}
			}
			return true;
        }

        editor.on("key", function (event) {
            if (editor.mode === "source") {
                updateCounter(event.editor);
            }
        }, editor, null, 100);

        editor.on("change", function (event) {
            updateCounter(event.editor);
        }, editor, null, 100);

        editor.on("uiSpace", function (event) {
            if (editor.elementMode === CKEDITOR.ELEMENT_MODE_INLINE) {
                if (event.data.space == "top") {
                    event.data.html += "<div class=\"cke_wordcount\" style=\"\"" +
                        " title=\"" +
                        editor.lang.wordcount.title +
                        "\"" +
                        "><span id=\"" +
                        counterId(event.editor) +
                        "\" class=\"cke_path_item\">&nbsp;</span></div>";
                }
            } else {
                if (event.data.space == "bottom") {
                    event.data.html += "<div class=\"cke_wordcount\" style=\"\"" +
                        " title=\"" +
                        editor.lang.wordcount.title +
                        "\"" +
                        "><span id=\"" +
                        counterId(event.editor) +
                        "\" class=\"cke_path_item\">&nbsp;</span></div>";
                }
            }

        }, editor, null, 100);

        editor.on("dataReady", function (event) {
            updateCounter(event.editor);
        }, editor, null, 100);

        editor.on("afterPaste", function (event) {
            updateCounter(event.editor);
        }, editor, null, 100);
        editor.on("blur", function () {
            if (intervalId) {
                window.clearInterval(intervalId);
            }
        }, editor, null, 300);
    }
});
