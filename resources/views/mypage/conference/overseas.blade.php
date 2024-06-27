@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu n2">
                    <li ><a href="{{ route('mypage.conference') }}">학술행사</a></li>
                    <li class="on"><a href="{{ route('mypage.overseas') }}">해외학회</a></li>
                </ul>
            </div>
            <div class="info-conbox text-center">
                <img src="/assets/image/sub/ic_regi_complete.png" alt="">
                <div class="tit">
                    <strong>{{$user->name_kr ?? ''}}</strong> 선생님의 국제학회 참가 지원 신청 내역 입니다.
                </div>
            </div>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table list-table">
                    <caption class="hide">해외학회 신청 내역</caption>
                    <colgroup>
                        <col>
                        <col>
                        <col style="width: 20%;">
                        <col style="width: 18%;">
                        <col style="width: 15%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">해외 학술대회명</th>
                        <th scope="col">개최일자</th>
                        <th scope="col">신청일</th>
                        <th scope="col">심사결과</th>
                        <th scope="col">관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($overseas as $key => $value)
                        <tr data-sid="{{ $value->sid }}">
                            <td>{{$value->conference->subject ?? ''}}</td>
                            <td>{{$value->conference->event_sdate ?? ''}}{{ !empty($value->conference->event_edate) ? ' ~ '.$value->conference->event_edate : '' }}</td>
                            <td>{{$value->created_at->format('Y-m-d') ?? ''}}</td>
                            <td>
                                <span class="state {{$overseasConfig['result_state'][$value->result?? '']}}">{{$overseasConfig['result'][$value->result?? '']}}</span>
                                @if(($value->result ?? '') == 'S')
                                    <br>
                                @if( date('Y-m-d') >= $value->conference->result_sdate && date('Y-m-d') <= $value->conference->result_edate )
                                    @if(($value->result_request_state ?? 'N') == 'N')
                                    <a href="{{ route('mypage.overseas_report', ['sid' => $value->sid]) }}" class="btn btn-type1 btn-small color-type13">결과보고 <span class="arrow">&gt;</span></a>
                                    @else
                                    <a href="{{ route('mypage.overseas_preview', ['sid' => $value->sid]) }}" class="btn btn-type1 btn-small color-type8">제출내역 <span class="arrow">&gt;</span></a>
                                    @endif
                                @endif
                                @endif
                            </td>
                            <td>
                                <div class="btn-admin">
                                    <a href="{{ route('overseas.register', ['sid' => $value->sid, 'mypage' => 'Y']) }}" class="btn btn-board btn-modify">수정</a>
                                    <a href="javascript:;" class="btn btn-board btn-delete">삭제</a>
                                </div>
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

        $(document).on('click', '.btn-delete', function() {
            const _case = 'overseas-delete';
            const _url = "{{ route('overseas.data') }}";

            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax( _url, { case: _case, sid: $(this).closest('tr').data('sid') } );
            }
        });

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