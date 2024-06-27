@php
    function getGrpSize($cnt, $total, $max, $width)
    {
        //현재수, 전체수, 가장큰수, 원하는길이
        if (!$width) return @intval($cnt/$total*100);

        if ($cnt) {
            return ($cnt == $max) ? $width : @intval($cnt / $max * $width);
        } else {
            return 0;
        }
    }
@endphp

@extends('admin.layouts.admin-layout')

@section('addStyle')
    <style>
        .statDiv {
            display: flex;
            justify-content: space-around;
        }
    </style>
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>접속통계 - {{ $lang == 'ko' ? '국문' : '영문' }}</h2>
        </div>

        <div class="util btn ar">
            <a href="{{ route('status.referer', ['lang' => $lang]) }}" class="btnSmall btnDef">접속경로 - {{ $lang == 'ko' ? '국문' : '영문' }}</a>
        </div>

        <div class="statDiv">
            <div style="width: 32.5%">
                <table class="tblDef listTbl">
                    <colgroup>
                        <col style="width: 16%">
                        <col style="width: 21%">
                        <col style="width: 21%">
                        <col style="width: 21%">
                        <col style="width: 21%">
                    </colgroup>

                    <thead>
                    <tr>
                        <th>
                            <select id="yearSelect" style="width: 100%;">
                                @for($i = 2023; $i <= (int)date('Y'); $i++)
                                    <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </th>
                        <th>접속자</th>
                        <th>(누적)</th>
                        <th>페이지뷰</th>
                        <th>(누적)</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php
                        $m_accessor_acc = 0; // 접속자 누적
                        $m_page_acc = 0; // 페이지 누적
                    @endphp
                    @foreach($statusConfig['month'] as $key => $val)
                        @php
                            $hit = $status['month'][$key]->hit;
                            $page = $status['month'][$key]->page;
                            $m_accessor_acc = ($m_accessor_acc + $hit ?? 0);
                            $m_page_acc = ($m_page_acc + $page ?? 0);
                        @endphp

                        <tr>
                            <th>{{ substr($val, 0, 3) }}</th>
                            <td>{{ empty($hit) ? '' : number_format($hit) }}</td>
                            <td>{{ empty($hit) ? '' : number_format($m_accessor_acc) }}</td>
                            <td>{{ empty($page) ? '' : number_format($page) }}</td>
                            <td>{{ empty($page) ? '' : number_format($m_page_acc) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div style="width: 32.5%">
                <table class="tblDef listTbl">
                    <colgroup>
                        <col style="width: 15%">
                        <col style="width: 15%">
                        <col style="width: 17%">
                        <col style="width: 17%">
                        <col style="width: 17%">
                        <col style="width: 17%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th colspan="2">
                            <select id="monthSelect" style="width: 100%;">
                                @foreach($statusConfig['month'] as $key => $val)
                                    <option value="{{ $key }}" {{ $key == $month ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>접속자</th>
                        <th>(누적)</th>
                        <th>페이지뷰</th>
                        <th>(누적)</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php
                        $d_accessor_acc = 0; // 접속자 누적
                        $d_page_acc = 0; // 페이지 누적
                    @endphp

                    @for($i = 1; $i <= date('t', mktime(0, 0, 0, $month, 1, $year)); $i++)
                        @php
                            $addDay = addZero($i, 2);
                            $hit = $status['day'][$addDay]->hit;
                            $page = $status['day'][$addDay]->page;
                            $d_accessor_acc = ($d_accessor_acc + $hit ?? 0);
                            $d_page_acc = ($d_page_acc + $page ?? 0);
                        @endphp

                        <tr>
                            <th>{{ $addDay }}</th>
                            <th>{{ getYoil(date("{$year}-{$month}-{$addDay}")) }}</th>
                            <td>{{ empty($hit) ? '' : number_format($hit) }}</td>
                            <td>{{ empty($hit) ? '' : number_format($d_accessor_acc) }}</td>
                            <td>{{ empty($page) ? '' : number_format($page) }}</td>
                            <td>{{ empty($page) ? '' : number_format($d_page_acc) }}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>

            <div style="width: 32.5%">
                <table class="tblDef listTbl">
                    <colgroup>
                        <col style="width: 15%">
                        <col style="width: 15%">
                        <col style="width: 17%">
                        <col style="width: *">
                    </colgroup>
                    <thead>
                    <tr>
                        <th colspan="2">
                            <select id="daySelect" style="width: 100%;">
                                @for($i = 1; $i <= date('t', mktime(0, 0, 0, $month, 1, $year)); $i++)
                                    <option value="{{ addZero($i, 2) }}" {{ addZero($i, 2) == $day ? 'selected' : '' }}>{{ addZero($i, 2) }}({{ getYoil(date("{$year}-{$month}-" .  addZero($i, 2))) }})</option>
                                @endfor
                            </select>
                        </th>
                        <th>접속자</th>
                        <th>그래프</th>
                    </tr>
                    </thead>

                    <tbody>

                    @php
                        $SUM_HMDX = 0;
                        $MAX_HMDX = 0;

                        foreach ($status['graph'] as $row) {
                            $SUM_HMDX += $row->cnt ?? 0;

                            if($MAX_HMDX < $row->cnt) {
                                $MAX_HMDX = $row->cnt;
                            }
                        }
                    @endphp

                    @for($i = 0; $i < 24; $i++)
                        @php
                            $addTime = addZero($i, 2);
                            $timeCnt = $status['graph'][$addTime]->cnt;
                        @endphp
                        <tr>
                            @if($i === 0)
                                <th rowspan="12">AM</th>
                            @endif

                            @if($i === 12)
                                <th rowspan="12">PM</th>
                            @endif

                            <th style="border-left:1px solid #dcdcdc !important;">{{ $addTime }}</th>
                            <td>
                                @if(!empty($timeCnt))
                                    {{ number_format($timeCnt) }}
                                    <span style="color:#c0c0c0;font-family:arial;font-size:10px;">({{ round($timeCnt / $SUM_HMDX * 100) }}%)</span>
                                @endif
                            </td>
                            <td>
                                <div style="width: {{ getGrpSize($timeCnt, $SUM_HMDX, $MAX_HMDX,100) }}%;height:10px;background:#194165;margin:0 3px 0 0;float:left;vertical-align:middle;"></div>
                            </td>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        $(document).on('change', '#yearSelect', function() {
            let url = '{{ route('status.stat', ['lang' => $lang]) }}';
            url = (url + '?year=' + $(this).val());
            location.replace(url);
        });

        $(document).on('change', '#monthSelect', function() {
            let url = '{{ route('status.stat', ['lang' => $lang, 'year' => $year]) }}';
            url = (url + '&month=' + $(this).val());
            location.replace(url);
        });

        $(document).on('change', '#daySelect', function() {
            let url = '{{ route('status.stat', ['lang' => $lang, 'year' => $year, 'month' => $month]) }}';
            url = (url + '&day=' + $(this).val());
            location.replace(url);
        });
    </script>
@endsection
