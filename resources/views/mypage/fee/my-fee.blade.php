@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="bg-box bg-gray bg-img-box">
                <img src="/assets/image/sub/ic_mypage03.png" alt="">
                <div class="text-wrap">
                    <strong class="tit">회비 납부 안내</strong>
                    <p>
                        회비 관련 문의는 학회 사무국으로 문의 바랍니다.
                    </p>
                </div>
            </div>
            <div class="sub-contit-wrap">
                <h4 class="sub-contit underline">{{ $user->name_kr ?? '' }} 님의 가입정보</h4>
            </div>
            <div class="write-wrap">
                <dl class="n2">
                    <dt>회원 구분</dt>
                    <dd>{{ $userConfig['level'][$user->level ?? ''] }}</dd>
                    <dt>회원가입 일시</dt>
                    <dd>{{ $user->created_at->format('Y-m-d') ?? '' }}</dd>
                </dl>
            </div>

            <div class="top-btn-wrap text-right">
            <?/*
                <a href="{{ route('mypage.feePopup', ['case' => 'fee', 'sid'=>0]) }}" class="btn btn-type1 color-type8 call_popup" data-popup_name="deposit" data-width="530" data-height="530">회비 납부하기</a>
            */?>
            </div>
            
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table list-table">
                    <caption class="hide">회비 납부 목록</caption>
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">회비 구분</th>
                        <th scope="col">금액</th>
                        <th scope="col">납부 일자</th>
                        <th scope="col">납부 상태</th>
                        <th scope="col">회비납부 / 영수증</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fee as $row)
                        <tr>
                            <td>{{ $row->year ?? '' }}년도</td>
                            <td>{{ number_format($row->price ?? 0) }}원</td>
                            <td>{{ $row->pay_date ?? '' }}</td>
                            <td>
                                @switch($row->pay_status)
                                    @case('A')
                                        <strong class="text-red">미납</strong>
                                        @break
                                    @default
                                        <strong class="text-blue">완납</strong>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @switch($row->pay_status)
                                    @case('A')
                                        <a href="{{ route('mypage.feePopup', ['case' => 'fee', 'sid' => $row->sid]) }}" class="btn btn-small color-type8 call_popup" data-popup_name="deposit" data-width="530" data-height="583">납부하기</a>
                                        @break
                                    @default
                                        <a href="javascript:;" class="btn btn-small color-type9" data-popup_name="receipt" data-width="530" data-height="620">영수증 출력</a>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </article>

@endsection

@section('addScript')
@endsection
