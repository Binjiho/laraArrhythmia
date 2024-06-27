@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">연구회/지회</h3>
            </div>

            @include('introduce.group.include.tab')

            <ul class="box-list n3 branch-list">
                @foreach($list as $row)
                    <li>
                        <a href="{{ route('introduce.group.detail', ['sid' => $row->sid]) }}">
                            <div class="logo-wrap">
                                @if($row->logo_realfile)
                                    <img src="{{ $row->logo_realfile }}" alt="">
                                @else
                                    {{ $row->subject }}
                                @endif
                            </div>

                            <ul>
                                @forelse($row->members as $key => $value)
                                    @if(strpos('회장,부회장,총무', $value->position) !== false)
                                    <li>
                                        <strong class="tit">{{ $value->position ?? '' }}</strong>
                                        <p>{{ $value->name_kr ?? '' }} / {{ $value->sosok ?? '' }}</p>
                                    </li>
                                    @endif
                                @empty
                                    <li class="no-data text-center">
                                        소속 인원이 없습니다.
                                    </li>
                                @endforelse
                            </ul>
                        </a>
                    </li>
                @endforeach

            </ul>

            <div class="paging-wrap">
                {{ $list->links('pagination::custom') }}
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection