@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">학술행사 자료</h3>
            </div>
            <div id="acco-board" class="board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        <form id="board-frm" data-sid="{{ $board->sid ?? 0 }}" data-case="program-{{ count($session_items) < 1 ? 'create' : 'update' }}" data-bsid="{{ request()->bsid ?? 0 }}" onsubmit="return false;">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>
                                <div class="top-btn-wrap text-right">
                                    <select name="session_cnt" id="session_cnt" class="form-item">
                                        @for($i=1;$i<11;$i++)
                                            <option value="{{$i}}" {{ count($session_items) == $i ? 'selected':'' }}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <a href="javascript:;" onclick="change_tr(this,'add');" class="btn btn-type1 color-type17 btn-add-session">세션 추가 <span class="plus">+</span></a>
                                </div>

                                <div class="write-wrap" id="fee_tbl">
                                    @forelse($session_items as $idx => $item)
                                        <div class="programs_tbl">
                                        <input type="hidden" name="program_sid[]" value="{{ $item->sid }}">
                                        <dl>
                                            <dt class="text-right">
                                                <a href="javascript:;" class="btn btn-small btn-board btn-delete" data-sid="{{ $item->sid }}">삭제</a>
                                            </dt>
                                        </dl>
                                        <dl>
                                            <dt><strong class="required">*</strong> 세션 선택</dt>
                                            <dd>
                                                <select name="ssid[]" id="ssid" class="form-item">
                                                    <option value="">선택</option>
                                                    @foreach($session_list as $session_item)
                                                        <option value="{{ $session_item->sid }}" {{$item->ssid == $session_item->sid ? 'selected':''}}>{{ $session_item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>프로그램 시간</dt>
                                            <dd>
                                                <input type="text" name="time[]" id="time" class="form-item" value="{{ $item->time ?? '' }}">
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt><strong class="required">*</strong> 주제</dt>
                                            <dd>
                                                <input type="text" name="title[]" id="title" class="form-item" value="{{ $item->title ?? '' }}">
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>연자이름 (소속)</dt>
                                            <dd>
                                                <input type="text" name="speaker[]" id="speaker" class="form-item" value="{{ $item->speaker ?? '' }}">
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>강의자료</dt>
                                            <dd>
                                                <div class="filebox">
                                                    <input class="upload-name form-item" id="fileName{{$idx}}" name="fileName[]" value="{{ $item->thumb_file ?? '' }}" placeholder="업로드" readonly="readonly">
                                                    <label for="file{{$idx}}">파일 업로드</label>
                                                    <input type="file" id="file{{$idx}}" name="file{{$idx}}" class="file_upload" value="" accept=".word,.pdf,.hwp" data-accept="word|pdf|hwp" onchange="fileCheck(this,$('#fileName{{ $idx }}') )" >
                                                    @if(!empty($item->thumb_realfile))
                                                        <div class="attach-file">
                                                            <a href="{{ $item->downloadFileUrl('thumb_realfile', 'thumb_file') }}" class="link">{{ $item->thumb_file }}</a>
                                                            <a href="javascript:void(0);" class="file_del" data-type="thumb" data-path="{{ $item->thumb_realfile }}"><img src="{{ asset('assets/image/icon/icon_del.png') }}" alt="삭제"></a>
                                                        </div>
                                                    @endif
                                                </div>

                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>동영상 링크</dt>
                                            <dd>
                                                <input type="text" name="link_url[]" id="link_url" class="form-item" value="{{ $item->link_url ?? '' }}">
                                            </dd>
                                        </dl>
                                    </div>
                                    @empty
                                        <div class="programs_tbl">
                                            <input type="hidden" name="program_sid[]" value="" readonly>
                                            <dl>
                                                <dt class="text-right">

                                                </dt>
                                            </dl>
                                            <dl>
                                                <dt><strong class="required">*</strong> 세션 선택</dt>
                                                <dd>
                                                    <select name="ssid[]" id="ssid" class="form-item">
                                                        <option value="">선택</option>
                                                        @foreach($session_list as $session_item)
                                                            <option value="{{ $session_item->sid }}">{{ $session_item->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt>프로그램 시간</dt>
                                                <dd>
                                                    <input type="text" name="time[]" id="time" class="form-item" value="">
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt><strong class="required">*</strong> 주제</dt>
                                                <dd>
                                                    <input type="text" name="title[]" id="title" class="form-item" value="">
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt>연자이름 (소속)</dt>
                                                <dd>
                                                    <input type="text" name="speaker[]" id="speaker" class="form-item" value="">
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt>강의자료</dt>
                                                <dd>
                                                    <div class="filebox">
                                                        <input class="upload-name form-item" id="fileName0" name="fileName[]" value="" placeholder="업로드" readonly="readonly">
                                                        <label for="file0">파일 업로드</label>
                                                        <input type="file" id="file0" name="file0" class="file_upload" value="" accept=".word,.pdf,.hwp" data-accept="word|pdf|hwp" onchange="fileCheck(this,$('#fileName0'))" >
                                                    </div>

                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt>동영상 링크</dt>
                                                <dd>
                                                    <input type="text" name="link_url[]" id="link_url" class="form-item" value="">
                                                </dd>
                                            </dl>
                                        </div>
                                    @endforelse
                                </div>

                                <div class="btn-wrap text-center">
                                    <a href="{{ route('library.sessions',['bsid'=>$board->sid ]) }}" class="btn btn-type1 color-type4">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type5">{{ count($session_items) < 1 ? '등록' : '수정' }}</button>
                                    <!-- <button type="submit" class="btn btn-type1 color-type5">수정</button> -->
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
    <script>
        const form = '#board-frm';
        const dataUrl = '{{route('library.data')}}';

        function change_tr(el, mode){
            if(mode == 'add'){

                // if($("select[name='session_cnt']").val() == $('.programs_tbl').length){
                //     alert('같은 숫자의 세션갯수입니다.');
                //     return false;
                // }

                let ajaxData = {};
                ajaxData.case = 'insert-program';
                ajaxData.session_cnt = $("select[name='session_cnt']").val();
                ajaxData.table_cnt = $('.programs_tbl').length;
                ajaxData.bsid = $('#board-frm').data('bsid');

                callAjax(dataUrl, ajaxData, true);
            }else{
                $(el).closest($(".programs_tbl")).remove();
            }
        }

        function move_order(el,mode){
            var target = $(el).closest($(".programs_tbl"));
            if( mode == "down" ){
                target.next().after(target);
            }else{
                target.prev().before(target);
            }
        }

        $(document).on('click', '.btn-delete', function() {
            const _case = 'program-delete';

            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax(dataUrl, { case: _case, sid: $(this).data('sid') });
            }
        });

        $(document).on('click', '.file_del', function() {
            let ajaxData = {};
            ajaxData.case = 'file-delete';
            ajaxData.fileType = $(this).data('type');
            ajaxData.filePath = $(this).data('path');

            actionConfirmAlert('삭제 하시겠습니까?', {'ajax': actionAjax(dataUrl, ajaxData)});
        });

        defaultVaildation();

        // 게시판 폼 체크
        $(form).validate({
            ignore: ['content', 'popup_content'],
            rules: {
                "ssid[]" : {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='ssid[]']").is(":visible");
                        }
                    },
                },
                "title[]" : {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='title[]']").is(":visible");
                        }
                    },
                },

            },
            messages: {
                "ssid[]" : {
                    isEmpty: '세션을 선택해주세요.',
                },
                "title[]": {
                    isEmpty: '세션 주제를 입력해주세요.',
                },
            },
            submitHandler: function() {

                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
