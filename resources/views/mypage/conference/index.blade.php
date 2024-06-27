@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu n2">
                    <li class="on"><a href="{{ route('mypage.conference') }}">학술행사</a></li>
                    <li><a href="{{ route('mypage.overseas') }}">해외학회</a></li>
                </ul>
            </div>

{{--            <div class="ready-wrap">--}}
{{--                <img src="/assets/image/sub/img_ready.png" alt="">--}}
{{--                <strong class="tit">페이지 <span class="highlights text-red">준비중</span> 입니다.</strong>--}}
{{--                <p>--}}
{{--                    이용에 불편을 드려 대단히 죄송합니다. <br>--}}
{{--                    빠른 시일내에 준비하여 찾아뵙겠습니다.--}}
{{--                </p>--}}
{{--            </div>--}}

            <div class="sub-contit-wrap">
                <h4 class="sub-contit underline">{{$user->name_kr ?? ''}} 님의 가입정보</h4>
            </div>
            <div class="write-wrap">
                <dl class="n2">
                    <dt>회원 구분</dt>
                    <dd>{{$userConfig['level'][$user->level ?? '']}}</dd>
                    <dt>회원가입 일시</dt>
                    <dd>{{$user->created_at->format('Y-m-d') ?? ''}}</dd>
                </dl>
            </div>

{{--            <div class="sub-contit-wrap">--}}
{{--                <h4 class="sub-contit underline">학술대회 참석 내역</h4>--}}
{{--            </div>--}}
{{--            <div class="table-wrap scroll-x touch-help">--}}
{{--                <table class="cst-table list-table">--}}
{{--                    <caption class="hide">학술대회 참석 내역</caption>--}}
{{--                    <colgroup>--}}
{{--                        <col style="width: 8%;">--}}
{{--                        <col style="width: 12%;">--}}
{{--                        <col>--}}
{{--                        <col style="width: 15%;">--}}
{{--                        <col style="width: 15%;">--}}
{{--                    </colgroup>--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">No</th>--}}
{{--                        <th scope="col">연도</th>--}}
{{--                        <th scope="col">행사명</th>--}}
{{--                        <th scope="col">행사일자</th>--}}
{{--                        <th scope="col">영수증 출력</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <td>2</td>--}}
{{--                        <td>2024</td>--}}
{{--                        <td class="text-left">제 7회 뇌졸중 예방 중재술 연구회 (SPRINT) 심포지엄</td>--}}
{{--                        <td>2024-02-16</td>--}}
{{--                        <td>--}}
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력</a>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>1</td>--}}
{{--                        <td>2024</td>--}}
{{--                        <td class="text-left">2023년도 대한부정맥학회 추계학술대회</td>--}}
{{--                        <td>2024-02-16</td>--}}
{{--                        <td>--}}
{{--                            <a href="#n" class="btn btn-small color-type9">영수증 출력</a>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
        </div>
    </article>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('mypage.data') }}';

        defaultVaildation();

        $(form).validate({
            rules: {
                password: {
                    isEmpty: true,
                },
            },
            messages: {
                password: {
                    isEmpty: '비밀번호를 입력해주세요.',
                },
            },
            submitHandler: function () {
                callAjax($(form).attr('action'), { case: 'check_confirm',toRoute:'mypage.modify', uid: $("input[name='uid']").val(), password: $("input[name='password']").val()}, true);
                // callMultiAjax($(form).attr('action'), getformData());
                // callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid') });
                // return true;
            }
        });
    </script>
@endsection