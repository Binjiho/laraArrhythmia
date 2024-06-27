@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>접속경로 - {{ $lang == 'ko' ? '국문' : '영문' }}</h2>
        </div>

        <div class="util btn ar">
            <a href="{{ route('status.stat', ['lang' => $lang]) }}" class="btnSmall btnDef">접속통계 - {{ $lang == 'ko' ? '국문' : '영문' }}</a>
        </div>

        <div class="formArea">
            <form method="get" id="referer-frm" action="{{ route('status.referer', ['lang' => $lang]) }}">
                <fieldset>
                    <table class="inputTbl">
                        <colgroup>
                            <col style="width: *;">
                            <col style="width: 80%;">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th>정렬조건</th>
                            <td>
{{--                                <select name="s" onchange="this.form.submit();" style="width:150px;">--}}
{{--                                    @for($i = 1; $i <= 20; $i++)--}}
{{--                                        <option value="{{ $i }}" {{ $i == (request()->s ?? '') ? 'selected' : '' }}>{{ $i }}/20구간</option>--}}
{{--                                    @endfor--}}
{{--                                </select>--}}

                                <select name="year" onchange="this.form.submit();" style="width:150px;">
                                    @for($i = 2023; $i <= (int)date('Y'); $i++)
                                        <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>

                                <select name="month" onchange="this.form.submit();" style="width:150px;">
                                    @foreach($statusConfig['month'] as $key => $val)
                                        <option value="{{ $key }}" {{ $month == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>

                                <select name="day" onchange="this.form.submit();" style="width:150px;">
                                    <option value="">- Daily -</option>
                                    @for($i = 1; $i <= date('t', mktime(0, 0, 0, $month, 1, $year)); $i++)
                                        @php
                                            $addDay = addZero($i, 2);
                                        @endphp
                                        <option value="{{ $addDay }}" {{ $day == $addDay ? 'selected' : '' }}>{{ $addDay }} ({{ getYoil(date("{$year}-{$month}-{$addDay}")) }})</option>
                                    @endfor
                                </select>

                                <div style="height:5px;"></div>

                                <select name="sort" onchange="this.form.submit();" style="width:150px;">
                                    @foreach($statusConfig['sort'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->sort  ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>

                                <select name="orderby" onchange="this.form.submit();" style="width:150px;">
                                    @foreach($statusConfig['orderby'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->orderby  ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>

                                <select name="recnum" onchange="this.form.submit();" style="width:150px;">
                                    @foreach($statusConfig['recnum'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->recnum ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>검색</th>
                            <td>
                                <select name="search">
                                    @foreach($statusConfig['search'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->search ?? '') == $key ? 'selected' : ''  }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="keyword" id="keyword" value="{{ request()->keyword }}" style="width: *;">
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="btn btnArea" style="padding-top: 10px;">
                        <button type="submit" class="btnDef btnBig" style="height: 40px;line-height: 37px !important;">검색</button>
                        <a href="{{ route('status.referer', ['lang' => $lang]) }}" class="btnPoint btnBig" style="height: 40px;line-height: 37px !important;">검색초기화</a>
                    </div>
                </fieldset>
            </form>
        </div>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: 6%;">
                <col style="width: 25%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 17%;">
                <col style="width: 10%;">
                <col style="width: 5%;">
                <col style="width: 17%;">
            </colgroup>

            <thead>
            <tr>
                <th>No</th>
                <th>접속경로</th>
                <th>검색엔진</th>
                <th>키워드</th>
                <th>IP</th>
                <th>Agent</th>
                <th>OS</th>
                <th>접속일시</th>
            </tr>
            </thead>

            <tbody>
            @forelse($list as $row)
                @php
                    $ENURL = explode(',' , $statusConfig['ENSET'][$row->search]);
                    $browzer =  $statusConfig['browser'][$row->agent];
                @endphp
                <tr>
                    <td>{{ $row->seq }}</td>
                    <td>
                        @if(!empty($row->referer))
                            <a href="{{ $row->referer }}" target="_blank" title="{{ $row->referer }}">{{ $row->referer }}</a>
                        @else
                            <span class="smallDotum" style="color:#c0c0c0;">직접접속</span>
                        @endif
                    </td>
                    <td>
                        @if(!empty($row->search))
                            <img src="/image/admin/image_new/ico_{{ $ENURL[1] }}.gif"/>
                            {{ $row->search }}
                        @endif
                    </td>
                    <td>{{ $row->keyword }}</td>
                    <td>{{ $row->ip }}</td>
                    <td><img src="/image/admin/image_new/bicon/{{ substr($browzer, 0, 1) }}.gif" alt="{{ $browzer }}" /></td>
                    <td>{{ $statusConfig['os'][$row->os] }}</td>
                    <td>{{ date('Y.m.d H:i:s', strtotime($row->d_regis)) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">로그 데이터가 없습니다.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <ul class="pager">
        {{ $list->links('pagination::custom') }}
    </ul>
@endsection

@section('addScript')
@endsection
