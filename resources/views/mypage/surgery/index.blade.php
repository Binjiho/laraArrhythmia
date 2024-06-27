@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox signup-intro inner-layer">

            @include('layouts.include.subTit')

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">중재시술인증내역</h4>
            </div>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table">
                    <caption class="hide">{{config('site.menu')['web']['sub'][$main_menu][$sub_menu]['name'] }}</caption>
                    <colgroup>
                        <col style="width: 8%;">
                        <col style="width: 12%;">
                        <col>
                        <col>
                        <col>
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">구분</th>
                        <th scope="col">심사등록코드</th>
                        <th scope="col">신청일자</th>
                        <th scope="col">인증년도</th>
                        <th scope="col">갱신일자</th>
                        <th scope="col">신청 현황</th>
                        <th scope="col">자세히보기</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($list as $key => $value)
                    <tr>
                        <td>{{ $value->renewal == 'N' ? '신규':'갱신' }}</td>
                        <td>{{ $value->regnum ?? '' }}</td>
                        <td>{{ $value->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $value->certi_date ? $value->certi_date->format('Y-m-d') : '미인증' }}</td>
                        <td>{{ $value->renewal_date ? $value->renewal_date->format('Y-m-d') : '' }}</td>
                        <td>
                            <span class="{{$surgeryConfig['result_css'][$value->result?? '']}}">{{$surgeryConfig['result'][$value->result?? '']}}</span>
                        </td>

{{--                        <td>--}}
{{--                            <a href="#n" class="btn btn-type2 btn-small color-type13">자세히보기 <span class="arrow">&gt;</span></a>--}}
{{--                        </td>--}}

                            <td>
                            @if(($reviewer ?? 'N') == 'Y')
                                @if( ($value->surgery_result($value->sid, thisPk())->state ?? 'N') == 'Y')
                                    심사완료
                                @else
                                    <a href="{{ route('surgery.judge', ['sid' => $value->sid ]) }}" class="btn btn-type2 btn-small color-type13 call_popup" data-popup_name="research-reviewer-register" data-width="1100" data-height="700">심사하기 <span class="arrow">&gt;</span></a>
                                @endif
                            @endif
                                <a href="{{ route('research.preview',[ 'sid'=>$value->sid ]) }}" class="btn btn-type2 btn-small color-type13 call_popup" data-popup_name="research-preview" data-width="1100" data-height="700">자세히보기 <span class="arrow">&gt;</span></a>
                            </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7">신청한 중재시술인증이 없습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <?/*
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">부정맥 중재시술인증의 심사리스트</h4>
            </div>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table">
                    <caption class="hide">부정맥 중재시술인증의 심사리스트</caption>
                    <colgroup>
                        <col style="width: 8%;">
                        <col style="width: 12%;">
                        <col>
                        <col>
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">구분</th>
                        <th scope="col">심사등록코드</th>
                        <th scope="col">신청자</th>
                        <th scope="col">소속</th>
                        <th scope="col">심사현황</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>신규</td>
                        <td>I-000</td>
                        <td>{신청자명}</td>
                        <td>{신청자 소속}</td>
                        <td>
                            <span class="state">신청완료</span>
                        </td>
                        <td>
                            <a href="#n" class="btn btn-type2 btn-small color-type13">심사하기 <span class="arrow">&gt;</span></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            */?>
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