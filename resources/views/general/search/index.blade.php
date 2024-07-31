@extends('general.layouts.general-layout')

@section('addStyle')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox sch-map-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">부정맥 전문가 찾기</h3>
            </div>
            <div class="bg-info-box">
                <div class="img-wrap"><img src="/html/general/assets/image/sub/img_hospital.png" alt=""></div>
                <div class="text-wrap">
                    <strong class="tit">부정맥 전문가 찾기</strong>
                    <p>
                        대한부정맥학회의 전문회원으로 활동하고 있는 부정맥 분야 전문가 정보를 안내해 드립니다. <br>
                        우리 지역에 있는 전문가를 찾아보세요!
                    </p>
                    <p class="text-right">
                        <span class="text-red">*부정맥 중재시술전문의란?</span> <br>
                        대한부정맥학회에서 자격심의를 통해 인증한 부정맥중재시술 전문가
                    </p>
                </div>
            </div>
            <div class="sch-wrap">
                <form id="search-frm" action="{{ route('general.search') }}" method="get">
                    <fieldset>
                        <legend class="hide">검색</legend>
                        <div class="form-group">
                            <select name="region" id="region" class="form-item">
                                <option value="">지역</option>
                                @foreach($searchConfig['region'] as $key => $val)
                                    @php
                                    $region_arr = explode('|',$val);
                                    @endphp
                                    <option value="{{ $key }}" {{ (request()->region ?? '') == $key ? 'selected' : '' }}>{{ $region_arr[0] }}</option>
                                @endforeach
                            </select>
                            <select name="category" id="category" class="form-item">
                                <option value="">분류</option>
                                @foreach($searchConfig['category'] as $key => $val)
                                    <option value="{{ $key }}" {{ (request()->category ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="keyword" class="form-item" value="{{ request()->keyword ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-sch">검색</button>
                    </fieldset>
                </form>
            </div>
            <div class="sch-map-wrap cf">
                <div class="map js-scroll-fixed">
                    <div class="map-img js-map-img">
                        <ul class="map-{{ $region }}">                            
                            <li id="map-1" class="{{ ($region ?? '') == '1' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '1']) }}">서울</a></li>
                            <li id="map-2" class="{{ ($region ?? '') == '2' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '2']) }}">인천</a></li>
                            <li id="map-3" class="{{ ($region ?? '') == '3' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '3']) }}">경기</a></li>
                            <li id="map-4" class="{{ ($region ?? '') == '4' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '4']) }}">대전</a></li>
                            <li id="map-5" class="{{ ($region ?? '') == '5' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '5']) }}">충북</a></li>
                            <li id="map-6" class="{{ ($region ?? '') == '6' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '6']) }}">충남</a></li>
                            <li id="map-7" class="{{ ($region ?? '') == '7' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '7']) }}">전북</a></li>
                            <li id="map-8" class="{{ ($region ?? '') == '8' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '8']) }}">광주</a></li>
                            <li id="map-9" class="{{ ($region ?? '') == '9' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '9']) }}">전남</a></li>
                            <li id="map-10" class="{{ ($region ?? '') == '10' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '10']) }}">대구</a></li>
                            <li id="map-11" class="{{ ($region ?? '') == '11' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '11']) }}">경북</a></li>
                            <li id="map-12" class="{{ ($region ?? '') == '12' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '12']) }}">부산</a></li>
                            <li id="map-13" class="{{ ($region ?? '') == '13' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '13']) }}">경남</a></li>
                            <li id="map-14" class="{{ ($region ?? '') == '14' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '14']) }}">강원</a></li>
                            <li id="map-15" class="{{ ($region ?? '') == '15' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '15']) }}">울산</a></li>
                            <li id="map-16" class="{{ ($region ?? '') == '16' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '16']) }}">제주</a></li>
                            <li id="map-17" class="{{ ($region ?? '') == '17' ? 'on' : '' }}"><a href="{{ route('general.search', ['region' => '17']) }}">세종</a></li>
                        </ul>
                    </div>
                </div>
                <div class="map-list-wrap">
                    <ul class="map-list">
                        @forelse($list as $row)
                            @if($row['level'] == 'S')
                                @php
                                    $category_title = '전문회원';
                                @endphp
                            @endif

                            @if(($row->surgery($row->sid)->certi ?? '') == 'Y')
                                @php
                                    $category_title = '부정맥 중재시술전문의';
                                @endphp
                            @endif

                            @if($row['level'] == 'S' && ($row->surgery($row->sid)->certi ?? '') == 'Y')
                                @php
                                    $category_title = '전문회원, 부정맥 중재시술전문의';
                                @endphp
                            @endif
                            <li data-sid="{{ $row->sid ?? '' }}">
                                <div class="text-wrap">
                                    <strong class="tit">
                                        {{ $row->name_kr ?? '' }}
                                        @foreach($userConfig['position'] as $position_key => $position_val)
                                            {{ in_array($position_key, $row->position ?? []) ? $position_val :'' }}
                                        @endforeach
                                        @if(in_array('99',$row->position ?? []))
                                            [ {{$row->position_etc ?? '' }} ]
                                        @endif
                                    </strong>
									<span>{{ $category_title ?? '' }} </span>
                                    <ul>
                                        @if($row->sosok_kr)
                                        <li class="name">
                                            {{ $row->sosok_kr ?? '' }}
                                        </li>
                                        @endif
                                        @if($row->office_addr1)
                                        <li class="location">
                                            {{ $row->office_addr1 ?? '' }} {{ $row->office_addr2 ?? '' }}
                                        </li>
                                        @endif
                                    </ul>
                                </div>

                                @if(!empty($row->image_path))
                                    <div class="img-wrap">
                                        <img src="{{ $row->image_path }}" alt="">
                                    </div>
                                @else
                                    <div class="img-wrap">
                                        <img src="/html/general/assets/image/sub/no_image.png" alt="">
                                    </div>
                                @endif
                            </li>
                        @empty
                            <li class="no-data">
                                찾으시는 부정맥 전문가가 없습니다.
                            </li>
                        @endforelse

                    </ul>

                    <div class="paging-wrap">
                        {{ $list->links('pagination::custom') }}
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection