@extends('layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
<div class="popup-wrap full" style="display: block;">
    <div class="popup-contents">
        <div class="popup-conbox popup-research-conbox">
            <div id="board" class="event-wrap board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        <form id="board-frm" data-sid="{{ $fee->sid ?? 0 }}" data-case="fee-{{ empty($fee->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                            <input type="hidden" name="user_sid" id="user_sid" value="{{ empty($fee->sid) ? '' : ($fee->user->sid ?? '') }}">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>
                                <div class="write-wrap">
                                    <dl>
                                        <dt>아이디</dt>
                                        <dd>
                                            <div class="form-group form-group-text n2">
                                                <input type="text" name="uid" id="uid" class="form-item" value="{{ $fee->user->uid ?? '' }}">
                                                <a href="javascript:void(0);" class="btn btn-small color-type2" id="uid_chk">검색</a>
                                            </div>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>성명</dt>
                                        <dd>
                                            <input type="text" name="name_kr" id="name_kr" class="form-item" value="{{ $fee->user->name_kr ?? '' }}" readonly>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>구분</dt>
                                        <dd>
                                            <div class="radio-wrap cst">
                                            @foreach($feeConfig['category'] as $key => $val)
                                                <div class="radio-group">
                                                    <input type="radio" name="category" id="category_{{$key}}" value="{{$key}}" {{ ( ($fee->category ?? '') == $key) ? 'checked' : '' }}>
                                                    <label for="category_{{$key}}">{{$val}}</label>
                                                </div>
                                            @endforeach
                                            </div>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>회비금액</dt>
                                        <dd>
                                            <input type="text" name="price" id="price" value="{{ $fee->price ?? '' }}" class="form-item" readonly>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>결제방법</dt>
                                        <dd>
                                            <div class="radio-wrap cst">
                                                @foreach($feeConfig['method'] as $key => $val)
                                                    <div class="radio-group">
                                                        <input type="radio" name="method" id="method_{{$key}}" value="{{$key}}" checked>
                                                        <label for="method_{{$key}}">{{$val}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>입금상태</dt>
                                        <dd>
                                            <div class="radio-wrap cst">
                                                @foreach($feeConfig['pay_status'] as $key => $val)
                                                    <div class="radio-group">
                                                        <input type="radio" name="pay_status" id="pay_status_{{$key}}" value="{{$key}}" {{ ( ($fee->pay_status ?? '') == $key) ? 'checked' : '' }}>
                                                        <label for="pay_status_{{$key}}">{{$val}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>입금자명</dt>
                                        <dd>
                                            <input type="text" name="depositor" id="depositor" value="{{ $fee->depositor ?? '' }}" class="form-item">
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>입금예정일</dt>
                                        <dd>
                                            <div class="form-group form-group-text">
                                                <input type="text" name="deposit_date" id="deposit_date" class="form-item" value="{{ $fee->deposit_date ?? '' }}" readonly datepicker>
                                            </div>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>입금완료일</dt>
                                        <dd>
                                            <div class="form-group form-group-text">
                                                <input type="text" name="pay_date" id="pay_date" class="form-item" value="{{ $fee->pay_date ?? '' }}" readonly datepicker>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>

                                <div class="btn-wrap text-center">
                                    <a href="javascript:void(0);" class="btn btn-type1 color-type4" id="board_cancel">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type5">{{ empty($fee->sid) ? '등록' : '수정' }}</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addScript')
    <script>
        const feeConfig = @json($feeConfig);
        const boardForm = '#board-frm';

        $(document).on('click', '#uid_chk', function() {
            const uid = $('input[name=uid]').val();

            let obj = {
                'case': true,
                'focus': 'input[name=uid]'
            };

            if(isEmpty(uid)) {
                obj.msg = '아이디를 입력해주세요.';
                actionAlert(obj);
                return;
            }

            callAjax('{{ route('fee.data') }}', {
                'case': 'uid-check',
                'uid': uid,
            });
        });

        $(document).on('click', $('input[name=category]'), function() {
            let _category = $('input[name=category]:checked').val();
            let _price = feeConfig['price'][_category];
            $("input[name='price']").val(_price);
        });

        // 게시글 작성 취소
        $(document).on('click', '#board_cancel', function(e) {
            e.preventDefault();

            const msg = ($(boardForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                self.close();
            }
        });


        defaultVaildation();

        // 게시판 폼 체크
        $(boardForm).validate({
            rules: {
                uid: {
                    isEmpty: true,
                },
                name_kr: {
                    isEmpty: true,
                },
                category: {
                    checkEmpty: true,
                },
                pay_status: {
                    checkEmpty: true,
                },
                depositor: {
                    isEmpty: true,
                },
                deposit_date: {
                    isEmpty: true,
                },
                pay_date: {
                    isEmpty: true,
                },
            },
            messages: {
                uid: {
                    isEmpty: '아이디를 입력해주세요.',
                },
                name_kr: {
                    isEmpty: '아이디를 검색해주세요.',
                },
                category: {
                    checkEmpty: '구분값을 선택해주세요.',
                },
                pay_status: {
                    checkEmpty: '입금상태값을 선택해주세요.',
                },
                depositor: {
                    isEmpty: '입금자명을 입력해주세요.',
                },
                deposit_date: {
                    isEmpty: '입금예정일을 입력해주세요.',
                },
                pay_date: {
                    isEmpty: '입금완료일을 입력해주세요.',
                },
            },
            submitHandler: function() {
                formSubmit();
            }
        });

        const formSubmit = () => {
            let ajaxData = newFormData(boardForm);

            // ajaxData.append('category','2');

            callMultiAjax('{{ route("fee.data") }}', ajaxData);
        }
    </script>

@endsection