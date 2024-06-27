// DOM 이 모두 로드 되었을 때 실행
jQuery(function(){
	$('span.inputR').on('click', function(){
		$target = $(this).find('input[type="radio"]');
		$parent_obj = $(this).parents('td');
		if($parent_obj.length==0){
			$parent_obj = $(this).parents('div.evaluation');
		}

		$(this).addClass('on');
		$parent_obj.find('span.inputR').not($(this)).removeClass('on');
	});

	$('span.inputC').on('click', function(){
		$target = $(this).find('input[type="checkbox"]');
		$parent_obj = $(this).parents('td');
		if($parent_obj.length==0){
			$parent_obj = $(this).parents('div.evaluation');
		}

		if($(this).hasClass('on')){
			$(this).removeClass('on');
		}else{
			$(this).addClass('on');
		}
		//$parent_obj.find('span.inputC').not($(this)).removeClass('on');
	});

	initial();


		var containerType = $("div.container").attr("class");
		if	(containerType == "container") {
			//컨텐츠 너비 고정
			var reWidth = $("div.container").width(),
				footer_pl = parseInt($("div.footer").css("padding-left"));

			//$("div.header").width(reWidth);
			//$("div.footer").width(reWidth - footer_pl);


			if ($("div.intro").length) {
				$("div.container").css("padding-top", "1px");
			}


		} else {
			//컨텐츠 너비 유동
			
		}



	var gnbType = $("div#containerWrap").attr("class");
	if (gnbType == "gnbLeft") {
//Gnb가 좌측에 위치
		gnbLeft_width();

		for (var i=0;i<$("ul#gnbUI > li").length;i++) {
			var subMenu = $("ul#gnbUI > li").eq(i).find("ul");
			if (subMenu.length) {
				subMenu.parent().addClass("subMenu");
			}
		}

		$("ul#gnbUI > li > a").on("click", function(){
			if ($(this).next().length > 0) {
				var sClass = $(this).attr("class");

				if (sClass == "on") {
					$(this).removeClass("on");
					$(this).next().slideUp()
				} else {
					$(this).addClass("on");
					$(this).next().slideDown()
				}
				return false
			}
		});

		

	} else {
//Gnb가 상단에 위치

		var minWidth = parseInt($("div.gnbWrap").css("min-width"));
		$("div.wrapper, div#headerWrap, div#footerWrap").css("min-width", minWidth);


		var hideGnb = null,
			gnbUI = $("ul#gnbUI"),
			gnbUI_w = gnbUI.width(),
			gnbUI_ea =  $("ul#gnbUI > li"),
			gnbUI_ea_w = Math.floor(gnbUI_w / gnbUI_ea.length),
			sumWidth = gnbUI_ea_w * gnbUI_ea.length;

		gnbUI_ea.width(gnbUI_ea_w - 1);
		gnbUI_ea.find("ul").css({
			"min-width":gnbUI_ea_w - 1
		});

		if (sumWidth < gnbUI_w) {
			var num = gnbUI_w - sumWidth;

			for (var i=1 ; i < num ; i++ ) {
				gnbUI_ea.eq(i).width(gnbUI_ea_w);
			}
		}

		for (var i=0;i<$("ul#gnbUI > li").length;i++) {
			var re_poLeft = $("ul#gnbUI > li").eq(i).position().left;
			$("ul#gnbUI > li").eq(i).find("ul").css({
				/*"left":re_poLeft*/
			});
		}

		$("ul#gnbUI > li > a").on("mouseenter focusin", function(){
			if (hideGnb != null) {
				clearTimeout(hideGnb);
			}															 
																 
			$("ul#gnbUI > li").removeClass("view");
			$(this).parent().addClass("view");
			$(this).next().show();
		});
		
		$("ul#gnbUI li li a").on("mouseenter focusin", function(){
			if (hideGnb != null) {
				clearTimeout(hideGnb);
			}															 
			
			$(this).parent().parent().find("ul").hide();
			$(this).next().show();
		});
		
		$("ul#gnbUI a").on("mouseleave focusout", function(){
			hideGnb = setTimeout(function(){
				$("ul#gnbUI > li").removeClass("view");
				$("ul#gnbUI ul").hide();
			}, 800);										 
		});



	}

	if ($("div.loginArea").length) {
		$("div.wrapper").addClass("loginWrap");
		if ($(window).height() > $("div.loginWrap").height()) {
			$("div.loginWrap").height($(window).height() - 100);
		}
 	}

	if ($("div.workshopIntro").length) {
		$("div.wrapper").addClass("bg");

 	}

//tooltip
	$(".tooltip > a").on("mouseenter", function(){
		this_w = $(this).attr('popwidth');
		$(this).next().width(this_w).show(); 
	});

	$(".tooltip > a").on("mouseleave", function(){
		$(this).next().hide(); 
	});



	$("a.trigger").on("click", function(){
		var _currToggle = $(this).parent().parent(),
			sClass = $(this).parent().attr("class");
		
		if (sClass != "view") {
			$(this).parent().addClass("view");
			$(this).find("i").attr("class",  function(i){
				var src = $(this).attr("class");
				return src.replace("-down", "-up");
			});
			_currToggle.find(".toggleCon").slideDown();
		} else {
			$(this).parent().removeClass("view");
			$(this).find("i").attr("class",  function(i){
				var src = $(this).attr("class");
				return src.replace("-up", "-down");
			});
			_currToggle.find(".toggleCon").slideUp();
		}

		return false
	});


});


// 페이지내 모든 요소가 로드되었을 때 실행
$(window).on("scroll resize", function(){

	var gnbType = $("div#containerWrap").attr("class"),
		gnb = $("div.gnbWrap"),
		gnbUI = $("ul#gnbUI");

	var header_h = $("div#headerWrap").outerHeight(),
		footer_h = $("div#footerWrap").outerHeight(),
		con_h = $("div#containerWrap").outerHeight(),
		win_h = $(window).height(),
		win_s = $(window).scrollTop();
	


	if (gnbType == "gnbLeft") {
//Gnb가 좌측에 위치

		var reMarginTop = win_s - header_h;
	
		if (reMarginTop > 0) {

			gnbUI.css({
				"margin-top":reMarginTop
			});
		} else {
			gnbUI.css({
				"margin-top":0
			});
		}


		gnbLeft_width();	


	} else {
//Gnb가 상단에 위치

		


		if (header_h > win_s) {
			gnb.removeClass("posF");

		} else {
			gnb.addClass("posF");

			var con_w = $("div.contents").outerWidth(),
				win_w = $(window).width(),
				win_hori_s = $(window).scrollLeft();

			if (con_w > win_w) {
				gnb.css({
					"margin-left": win_hori_s * (-1)
				});
			}

		}
	}

});






//브라우저 창 보다 컨텐츠 높이가 낮을 때
function initial() {


	var header_h = $("div#headerWrap").outerHeight(),
		footer_h = $("div#footerWrap").outerHeight(),
		win_h = $(window).height(),
		gnb = $("div.gnbWrap"),
		footer_h = $("div#footerWrap").outerHeight(),
		gnbType = $("div#containerWrap").attr("class"),
		con_h = $("div.container").outerHeight(),
		reHeight = win_h - header_h - footer_h;
		

	if (gnbType == "gnbLeft") {
//Gnb가 좌측에 위치


	} else {
//Gnb가 상단에 위치
		if (con_h > reHeight) {
			reHeight = con_h;
		}
		var gnb_h = 60 + 30;
	
		$("div.container").css("min-height",reHeight-3);
		$("div.container").css({"padding-top":gnb_h});

		var conH = $("div.container").height();
		$("div.contents").css("min-height",conH );
		
	}
}


// Gnb가 좌측에 위치할때 width 재정의 함수
function gnbLeft_width() {

}


// GNB가 상단일 때 gnb용 함수
function gnbView() {
}




















