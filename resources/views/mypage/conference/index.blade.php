@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
{{--            <div class="sub-tab-wrap">--}}
{{--                <ul class="sub-tab-menu n2">--}}
{{--                    <li class="on"><a href="{{ route('mypage.conference') }}">학술행사</a></li>--}}
{{--                    <li><a href="{{ route('mypage.overseas') }}">해외학회</a></li>--}}
{{--                </ul>--}}
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

            <div class="sub-contit-wrap">
                <h4 class="sub-contit underline">학술대회 참석 내역</h4>
            </div>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table list-table">
                    <caption class="hide">학술대회 참석 내역</caption>
                    <colgroup>
                        <col style="width: 8%;">
                        <col style="width: 12%;">
                        <col>
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">연도</th>
                        <th scope="col">행사명</th>
                        <th scope="col">행사일자</th>
                        <th scope="col">영수증 출력</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($regist as $key => $value)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $value->conference->year }}</td>
                        <td class="text-left">{{ $value->conference->subject }}</td>
                        <td>{{ $value->conference->event_sdate->format('Y-m-d') }} ~ {{ $value->conference->event_edate->format('Y-m-d') }}</td>
                        <td>
                            <a href="javascript:alert('준비중입니다.');" class="btn btn-small color-type9">영수증 출력</a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5">신청한 학술대회가 없습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

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