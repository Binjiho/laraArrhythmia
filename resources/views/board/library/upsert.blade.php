@extends($extends_str)

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}"/>
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @if(($extends_str ?? 'main') == 'layouts.web-layout')
                @include('layouts.include.subTit')
            @endif

            <div id="acco-board" class="board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        <form id="board-frm" data-sid="{{ $board->sid ?? 0 }}" data-case="board-{{ empty($board->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>
                                <div class="write-wrap">
                                @if($boardConfig['use']['writer'])
                                    <dl>
                                        <dt><strong class="required">*</strong> 작성자</dt>
                                        <dd>
                                            <input type="text" name="name" id="name" class="form-item" value="{{ $board->name ?? '' }}">
                                        </dd>
                                    </dl>
                                @endif

                                @if($boardConfig['use']['category'])
                                    <dl>
                                        <dt><strong class="required">*</strong> {{$boardConfig['category']['name']}}</dt>
                                        <dd>
                                            <select name="category" id="category" class="form-item" onchange="category2_change(this.value)">
                                                <option value="">선택</option>
                                                @foreach($boardConfig['category']['item'] as $category_key => $category_val)
                                                    <option value="{{ $category_key }}" {{ ($board->category ?? '') == $category_key ? 'selected' : '' }}>{{ $category_val }}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                    </dl>
                                @endif

                                @if($boardConfig['use']['category2'])
                                    <dl>
                                        <dt><strong class="required">*</strong> {{$boardConfig['category2']['name']}}</dt>
                                        <dd>
                                            <select name="category2" id="category2" class="form-item" {{($board->category ?? '') != '1' || ($board->category ?? '') != '7' ? 'disabled=disabled' : ''}}>
                                                <option value="">선택</option>
                                                @foreach($boardConfig['category2']['item'][$category] as $category2_key => $category2_val)
                                                    <option value="{{ $category2_key }}" {{ ($board->category2 ?? '') == $category2_key ? 'selected' : '' }}>{{ $category2_val }}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                    </dl>
                                @endif

                                    <dl>
                                        <dt><strong class="required">*</strong> {{ $boardConfig['subject'] }}</dt>
                                        <dd>
                                            <input type="text" name="subject" id="subject" class="form-item" value="{{ $board->subject ?? '' }}">
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>학술대회 원고 URL</dt>
                                        <dd>
                                            <input type="text" name="linkurl2" id="linkurl2" class="form-item" value="{{ $board->linkurl2 ?? '' }}">
                                        </dd>
                                    </dl>

                                    @if($boardConfig['use']['file'])
                                        <dl>
                                            <dt>프로그램북</dt>
                                            <dd>
                                                <div class="filebox">
                                                    <input class="upload-name form-item" value="{{ $board->thumb_file ?? '' }}" placeholder="파일첨부" readonly>
                                                    <label for="thumb_file">파일첨부</label>
                                                    <input type="file" id="thumb_file" name="thumb_file" class="file-upload" >
                                                    @if (!empty($board->thumb_file))
                                                        <div class="attach-file">
                                                            <a href="{{ $board->downloadFileUrl('thumb_realfile', 'thumb_file') }}" target="_blank" class="link">{{$board->thumb_file}}</a>
                                                            <a href="javascript:void(0);" class="file_del" data-type="thumb" data-path="{{ $board->thumb_realfile }}"><img src="{{ asset('assets/image/icon/icon_del.png') }}" alt="삭제"></a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif

                                    @if($boardConfig['use']['link'])
                                        <dl>
                                            <dt>홈페이지 URL</dt>
                                            <dd>
                                                <input type="text" name="linkurl" id="linkurl" class="form-item" value="{{ $board->linkurl ?? '' }}">
                                            </dd>
                                        </dl>
                                    @endif

                                    <dl>
                                        <dt>일시</dt>
                                        <dd>
                                            <div class="radio-wrap cst">
                                                @foreach($boardConfig['options']['date_type'] as $key => $val)
                                                    <div class="radio-group">
                                                        <input type="radio" name="date_type" id="date_type_{{ $key }}" value="{{ $key }}" {{ (($board->date_type ?? '') == $key) ? 'checked' : '' }}>
                                                        <label for="date_type_{{ $key }}">{{$val}}</label>
                                                    </div>
                                                @endforeach

                                                <div class="radio-group form-group form-group-text n2">
                                                    <input type="text" name="event_sdate" id="event_sdate" class="form-item" value="{{ $board->event_sdate ?? '' }}" readonly datepicker>
                                                    <span class="text">~</span>
                                                    <input type="text" name="event_edate" id="event_edate" class="form-item" value="{{ $board->event_edate ?? '' }}" readonly datepicker {{ (($board->date_type ?? '') == 'D') ? 'disabled' : '' }}>
                                                </div>
                                            </div>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>장소</dt>
                                        <dd>
                                            <input type="text" name="place" id="place" class="form-item" value="{{ $board->place ?? '' }}">
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>주최</dt>
                                        <dd>
                                            <input type="text" name="host" id="host" class="form-item" value="{{ $board->host ?? '' }}">
                                        </dd>
                                    </dl>
                                    @if($boardConfig['use']['hide'])
                                        <dl>
                                            <dt><strong class="required">*</strong> 공개 여부</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['hide'] as $hide_key => $hide_val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="hide" id="hide_{{ $hide_key }}" value="{{ $hide_key }}" {{ (($board->hide ?? 'N') == $hide_key) ? 'checked' : '' }}>
                                                            <label for="hide_{{ $hide_key }}">{{$hide_val}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif
                                </div>


                                <div class="top-btn-wrap">
                                    <a href="javascript:;" onclick="change_tr(this,'add');" class="btn btn-type1 color-type17 btn-add-session">세션 추가 <span class="plus">+</span></a>
                                    <span class="help-text text-blue">
                                    ※ 세션 추가 버튼을 클릭하시면 세션 입력 테이블이 추가 됩니다.
                                    </span>
                                </div>

                                <div class="write-wrap" id="fee_tbl">
                                @if(!empty($board->sid) && $board->sessions->count() > 0)
                                    @foreach($board->sessions as $key => $session_item)
                                        <dl>
                                            <input type="hidden" name="session_sid[]" value="{{ $session_item['sid'] }}" readonly>
                                            <dt>세션 입력</dt>
                                            <dd>
                                                <div class="session-write-con">
                                                    <div class="session-form-group">
                                                        <div class="form-group">
                                                            <input type="text" name="title[]" value="{{ $session_item['title'] }}" id="" class="form-item" placeholder="세션 타이틀">
                                                        </div>
                                                        <div class="form-group n2 mt-10">
                                                            <input type="text" name="chair_person[]" value="{{ $session_item['chair_person'] }}" id="" class="form-item" placeholder="좌장이름 (소속)">
                                                            <input type="text" name="room[]" value="{{ $session_item['room'] }}" id="" class="form-item" placeholder="Room">
                                                        </div>
                                                    </div>
                                                    <div class="btn-admin">
                                                        <button type="button" class="btn btn-arrow" onclick="move_order(this,'up')"><img src="/assets/image/icon/ic_arrow_top.png" alt="위로"></button>
                                                        <button type="button" class="btn btn-arrow" onclick="move_order(this,'down')"><img src="/assets/image/icon/ic_arrow_bottom.png" alt="아래로"></button>
                                                        <a href="javascript:;" onclick="change_tr(this,'del');" class="btn btn-board btn-delete">삭제</a>
                                                    </div>
                                                </div>
                                            </dd>
                                        </dl>
                                    @endforeach
                                @else
                                    <dl>
                                        <input type="hidden" name="session_sid[]" value="" readonly>
                                        <dt>세션 입력</dt>
                                        <dd>
                                            <div class="session-write-con">
                                                <div class="session-form-group">
                                                    <div class="form-group">
                                                        <input type="text" name="title[]" value="" id="" class="form-item" placeholder="세션 타이틀">
                                                    </div>
                                                    <div class="form-group n2 mt-10">
                                                        <input type="text" name="chair_person[]" value="" id="" class="form-item" placeholder="좌장이름 (소속)">
                                                        <input type="text" name="room[]" value="" id="" class="form-item" placeholder="Room">
                                                    </div>
                                                </div>
                                                <div class="btn-admin">
                                                    <button type="button" class="btn btn-arrow" onclick="move_order(this,'up')"><img src="/assets/image/icon/ic_arrow_top.png" alt="위로"></button>
                                                    <button type="button" class="btn btn-arrow" onclick="move_order(this,'down')"><img src="/assets/image/icon/ic_arrow_bottom.png" alt="아래로"></button>
                                                    <a href="javascript:;" onclick="change_tr(this,'del');" class="btn btn-board btn-delete">삭제</a>
                                                </div>
                                            </div>
                                        </dd>
                                    </dl>
                                @endif
                                </div>

                                <div class="write-wrap">
                                    @if($boardConfig['use']['plupload'] && ($board->files_count ?? 0) > 0)
                                        <dl>
                                            <dt>첨부 파일</dt>
                                            <dd>
                                                <div class="filebox">
                                                    @foreach($board->files as $file)
                                                        <div class="attach-file">
                                                            <a href="{{ $file->downloadUrl() }}" target="_blank" class="link">{{ $file->filename }}</a>
                                                            <a href="javascript:void(0);" class="file_del" data-type="plupload" data-path="{{ $file->realfile }}"><img src="{{ asset('assets/image/icon/icon_del.png') }}" alt="삭제"></a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif

                                    <dl>
                                        <dd>
                                            <textarea name="content" id="content" class="tinymce">{{ $board->content ?? '일시 :<br>장소 :<br>주최 :' }}</textarea>
                                        </dd>
                                    </dl>

                                    @if($boardConfig['use']['plupload'])
                                        <dl>
                                            <dd>
                                                <div id="plupload"></div>
                                            </dd>
                                        </dl>
                                    @endif
                                </div>

                                <div class="btn-wrap text-center">
                                    <a href="javascript:void(0);" class="btn btn-type1 color-type4" id="board_cancel">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type5">{{ empty($board->sid) ? '등록' : '수정' }}</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    @include("board.{$boardConfig['skin']}.script.default-script")
    <script>
        $(function(){
            if( $("#category").val() == '1'/*KHRS*/ || $("#category").val() == '5'/*부정맥연구회*/) {
                $('#category2').attr('disabled', false);
            }
        });

        $(document).on('click', '.file_del', function() {
            let ajaxData = {};
            ajaxData.case = 'file-delete';
            ajaxData.fileType = $(this).data('type');
            ajaxData.filePath = $(this).data('path');

            actionConfirmAlert('삭제 하시겠습니까?', {'ajax': actionAjax(dataUrl, ajaxData)});
        });

        $(document).on('click', 'input[name=date_type]', function() {
            let _type = $(this).val();
            if(_type == 'D'/*하루행사*/){
                $("input[name='event_edate']").val('');
                $("input[name='event_edate']").prop('disabled',true);
            }else{
                $("input[name='event_edate']").prop('disabled',false);
            }
        });

        function category2_change(el){
            if( el == '1'/*KHRS*/ || el == '5'/*부정맥연구회*/) {
                $('#category2').attr('disabled', false);
                let cate2Arr = boardConfig['category2']['item'][el];
                $('#category2').empty();
                $('#category2').append( "<option value=\'\'>선택</option>" );
                for ( var key in cate2Arr ) {
                    $('#category2').append( "<option value=\'"+key+"\'>" + cate2Arr[ key ] + "</option>" );
                }
            }else{
                $('#category2').attr('disabled', 'disabled');
                $('#category2').val('');
            }
        }

        function change_tr(el, mode){
            if(mode == 'add'){
                var _html = "";
                _html += "<dl>";
                _html += "<input type=\"hidden\" name=\"session_sid[]\" class=\"form-item\" readonly>";
                _html += "<dt>세션 입력</dt>";
                _html += "<dd>";
                _html += "<div class=\"session-write-con\">";
                _html += "<div class=\"session-form-group\">";
                _html += "<div class=\"form-group\">";
                _html += "<input type=\"text\" name=\"title[]\" class=\"form-item\" placeholder=\"세션 타이틀\">";
                _html += "</div>";
                _html += "<div class=\"form-group n2 mt-10\">";
                _html += "<input type=\"text\" name=\"chair_person[]\" class=\"form-item\" placeholder=\"좌장이름 (소속)\"> ";
                _html += "<input type=\"text\" name=\"room[]\" class=\"form-item\" placeholder=\"Room\">";
                _html += "</div>";
                _html += "</div>";

                _html += "<div class=\"btn-admin\">";
                _html += "<button type=\"button\" onclick=\"move_order(this,'up');\" class=\"btn btn-arrow\"><img src=\"/assets/image/icon/ic_arrow_top.png\" alt=\"위로\"></button> ";
                _html += "<button type=\"button\" onclick=\"move_order(this,'down');\" class=\"btn btn-arrow\"><img src=\"/assets/image/icon/ic_arrow_bottom.png\" alt=\"아래로\"></button> ";
                _html += "<a href=\"javascript:;\" onclick=\"change_tr(this,'del');\" class=\"btn btn-board btn-delete\">삭제</a>";
                _html += "</div>";

                _html += "</div>";
                _html += "</dd>";
                _html += "</dl>";

                $("#fee_tbl").append(_html);
            }else{
                $(el).closest("dl").remove();
                // if($("#fee_tbl").find("dl").length < 2){
                //     alert('최소 한개 이상은 입력해주세요.');
                //     return false;
                // }else{
                //     $(el).closest("dl").remove();
                // }
            }
        }

        function move_order(el,mode){
            var target = $(el).closest("dl");
            if( mode == "down" ){
                target.next().after(target);
            }else{
                target.prev().before(target);
            }
        }

        // 게시글 작성 취소
        $(document).on('click', '#board_cancel', function(e) {
            e.preventDefault();

            const msg = ($(boardForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                location.replace('{{ route('board', ['code' => $code]) }}');
            }
        });

        // 첨부파일 (plupload) 사용시
        if(boardConfig.use.plupload) {
            pluploadInit({
                multipart_params: {
                    directory: boardConfig.directory,
                },
                filters: {
                    max_file_size: '20mb'
                },
            });
        }

        defaultVaildation();

        // 게시판 폼 체크
        $(boardForm).validate({
            ignore: ['content', 'popup_content'],
            rules: {
                name: {
                    isEmpty: true,
                },
                subject: {
                    isEmpty: true,
                },
                category: {
                    isEmpty: true,
                },
                category2: {
                    isEmpty: true,
                },
                date_type: {
                    isEmpty: true,
                },
                event_sdate: {
                    isEmpty: true,
                },
                event_edate: {
                    // isEmpty: true,
                    isEmpty: {
                        depends: function (element) {
                            return $("input[name='date_type']:checked").val() === 'L';
                        }
                    }
                },
                hide: {
                    checkEmpty: true,
                },
                // "title[]" : {
                //     isEmpty: {
                //         depends: function(element) {
                //             return $("input[name='title[]']").is(":visible");
                //         }
                //     },
                // },
                // "chair_person[]" : {
                //     isEmpty: {
                //         depends: function(element) {
                //             return $("input[name='chair_person[]']").is(":visible");
                //         }
                //     },
                // },
                // "room[]" : {
                //     isEmpty: {
                //         depends: function(element) {
                //             return $("input[name='room[]']").is(":visible");
                //         }
                //     },
                // },
                popup: {
                    checkEmpty: true,
                },
                popup_content: {
                    PopupIsTinyEmpty: true,
                },
                content: {
                    isTinyEmpty: true,
                },
            },
            messages: {
                name: {
                    isEmpty: '작성자를 입력해주세요.',
                },
                subject: {
                    isEmpty: `${boardConfig.subject}을 입력해주세요.`,
                },
                category: {
                    isEmpty: '카테고리1을 선택해주세요.',
                },
                category2: {
                    isEmpty: '카테고리2를 선택해주세요.',
                },
                date_type: {
                    isEmpty: '행사기간을 선택해주세요.',
                },
                event_sdate: {
                    isEmpty: '행사일 시작날짜를 선택해주세요.',
                },
                event_edate: {
                    isEmpty: '행사일 마감날짜를 선택해주세요.',
                },
                hide: {
                    checkEmpty: '공개여부를 체크해주세요.',
                },
                "title[]": {
                    isEmpty: '세션 타이틀을 입력해주세요.',
                },
                "chair_person[]" : {
                    isEmpty: '좌장이름(소속)을 입력해주세요.',
                },
                "room[]" : {
                    isEmpty: 'Room을 입력해주세요.',
                },
                popup: {
                    checkEmpty: '팝업 설정을 체크해주세요.',
                },
                popup_content: {
                    PopupIsTinyEmpty: '팝업 내용을 입력해주세요.',
                },
                content: {
                    isTinyEmpty: '내용을 입력해주세요.',
                },
            },
            submitHandler: function() {
                if(boardConfig.use.plupload) { // plupload 사용할때
                    const plupload_queue = $('#plupload').pluploadQueue();

                    let fileCnt = plupload_queue.files.length;
                    fileCnt = (fileCnt - previousUploadedFilesCount);

                    if (fileCnt > 0) {
                        spinnerShow();
                        plupload_queue.start();

                        plupload_queue.bind('UploadComplete', function(up, files) {
                            spinnerHide();

                            if (plupload_queue.total.failed === 0) {
                                previousUploadedFilesCount = up.files.length; // 업로드된 파일 수를 저장
                                boardSubmit();
                            } else {
                                alert('파일 업로드 실패');
                                location.reload();
                            }
                        });

                        return false;
                    }
                }

                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(boardForm);
            ajaxData.append('content', tinymce.get('content').getContent());
            // ajaxData.append('popup_content', tinymce.get('popup_content').getContent());
            ajaxData.append('plupload_file', JSON.stringify(plupladFile));

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
