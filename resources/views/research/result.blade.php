@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')

            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table">
                    <caption class="hide">{{config('site.menu')['web']['sub'][$main_menu][$sub_menu]['name'] }}</caption>
                    <colgroup>
                        <col>
                        <col>
                        <col>
                        <col style="width: 20%;">
                        <col>
                        <col>
                        <col>
                        <col style="width: 12%;">

                        <col style="width: 12%;">

                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col" colspan="9">연구명</th>
                    </tr>
                    <tr>
                        <th scope="col">신청자</th>
                        <th scope="col">소속</th>
                        <th scope="col">책임자</th>
                        <th scope="col">연구기간</th>
                        <th scope="col">과제구분</th>
                        <th scope="col">연구비용</th>
                        <th scope="col">신청일</th>
                        <th scope="col">심사현황</th>

                        <th scope="col">자세히보기</th>

                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $affi = getAffiNm();
                    @endphp

                    @forelse($list as $key => $value)
                    <tr>
                        <td class="text-left" colspan="7">
                            <p class="text-pink"><strong class="fw-500">{{$value -> subject ?? ''}}</strong></p>
                        </td>
                        <td rowspan="2">
                            @if( (strtotime($value->sdate) <= now()->getTimestamp() ) && ( strtotime($value->edate) >= now()->getTimestamp()) )
                                <span class="text-skyblue">진행보고</span>
                                <br>
                                <a href="{{ route('research.report',[ 'sid'=>$value->sid ]) }}" class="btn btn-type2 btn-small color-type19 call_popup" data-popup_name="research-report" data-width="1100" data-height="700">결과보고 <span class="arrow">&gt;</span></a>
                            @else
                                <span class="{{$researchConfig['result_css'][$value->result?? '']}}">{{$researchConfig['result'][$value->result?? '']}}</span>
                            @endif
                        </td>

                        @if(($reviewer ?? 'N') == 'Y')
                            <td rowspan="2">
                                @if( ($value->research_result($value->sid, thisPk())->state ?? 'N') == 'Y')
                                    심사완료
                                @else
                                    <a href="{{ route('mypage.research.reviewer.regist', ['sid' => $value->sid ]) }}" class="btn btn-type2 btn-small color-type13 call_popup" data-popup_name="research-reviewer-register" data-width="1100" data-height="700">심사하기 <span class="arrow">&gt;</span></a>
                                @endif
                                <a href="{{ route('research.preview',[ 'sid'=>$value->sid ]) }}" class="btn btn-type2 btn-small color-type13 call_popup" data-popup_name="research-preview" data-width="1100" data-height="700">자세히보기 <span class="arrow">&gt;</span></a>
                            </td>
                        @else
                            <td rowspan="2">
                                <a href="{{ route('research.preview',[ 'sid'=>$value->sid ]) }}" class="btn btn-type2 btn-small color-type13 call_popup" data-popup_name="research-preview" data-width="1100" data-height="700">자세히보기 <span class="arrow">&gt;</span></a>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td>{{$value->user->name_kr ?? ''}}</td>
                        <td>{{ ($value->user->sosok ?? '') ? $affi[$value->user->sosok] : '' }}</td>
                        <td>{{$value->name ?? ''}}</td>
                        <td>{{$value->sdate ?? ''}} ~ {{$value->edate ?? ''}}</td>
                        <td>{{$researchConfig['date_type'][$value->date_type?? '']}}</td>
                        <td>{{number_format($value->tot_price) ?? ''}}원</td>
                        <td>{{$value->created_at->format('Y-m-d') ?? ''}}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="9">신청한 연구비가 없습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection