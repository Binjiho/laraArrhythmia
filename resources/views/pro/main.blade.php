@extends('pro.layouts.pro-layout')

@section('addStyle')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection

@section('contents')
<!--
    main일 때 class="main",
    sub일 때 class="sub"
-->

<article class="main-visual js-main-visual">
    <div class="main-visual-con main-visual-con01">
        <div class="main-visual-text inner-layer">
            <h2 class="main-visual-tit font-pre">대한부정맥학회</h2>
            <p>
                부정맥 극복을 위한 창의적인 연구, <br>
                인재교육 및 국민인식 개선을 통해 의료의 선진화를 주도해 나가는 학회
            </p>
        </div>
    </div>
	<a href="https://www.k-hrs.org/board/noticePro/view/536" target="_blank">
		<div class="main-visual-con main-visual-con02">
			<div class="main-visual-text inner-layer">			
				<h2 class="main-visual-tit font-pre">대한부정맥학회</h2>
				<p>
					부정맥 극복을 위한 창의적인 연구, <br>
					인재교육 및 국민인식 개선을 통해 의료의 선진화를 주도해 나가는 학회
				</p>			
			 </div>		
		</div>
	</a>
	  <!-- <div class="main-visual-con main-visual-con02">
	  			<a href="https://www.k-hrs.org/board/noticePro/view/536" target="_blank"><img src="/html/specialist/assets/image/main/img_mainvisual240712.png" alt="" class="p-show"></a>
	  			<a href="https://www.k-hrs.org/board/noticePro/view/536" target="_blank"><img src="/html/specialist/assets/image/main/img_mainvisual240712_m.png" alt="" class="m-show"></a>
	  		</div> -->
    </div>    
    </div>
</article>
<article class="main-contents inner-layer">
    <ul class="main-quick-list">
        <li><a href="{{ route('board',['code'=>'noticePro']) }}"><strong class="tit">공지사항</strong></a></li>
        <li><a href="{{ route('conference',['year'=>date('Y')]) }}"><strong class="tit">학술대회 일정</strong></a></li>
        <li><a href="{{ route('board',['code'=>'library', 'category'=>'1', 'category2'=>'1']) }}"><strong class="tit">학술대회 자료</strong></a></li>
        <li><a href="{{ route('academy',[]) }}"><strong class="tit">학회지 관련 안내</strong></a></li>
        <li><a href="{{ route('introduce',[]) }}"><strong class="tit">대한부정맥학회</strong></a></li>
    </ul>
</article>
<article class="main-contents">
    <div class="inner-layer">
        <div class="video-rolling-wrap">
            <div class="main-tit-wrap">
                <h3 class="main-tit">부정맥 동영상으로 알아보기</h3>
            </div>
            <div class="video-rolling js-video-rolling">
                @foreach($video ?? [] as $row)
                    <div class="video-rolling-con">
                        <a href="{{ route('board.view', ['code' => 'video', 'category' => $row->category, 'sid' => $row->sid]) }}">
                            <div class="img-wrap">
                                <img src="{{ $row->thumb_realfile }}" alt="">
                            </div>
                            <div class="tit ellipsis">{{ $row->subject }}</div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="btn-wrap">
                <button type="button" class="btn-video btn-video-prev"><span class="hide">이전</span>&lt;</button>
                <button type="button" class="btn-video btn-video-next"><span class="hide">다음</span>&gt;</button>
                <a href="#n" class="btn btn-video btn-more"><span class="hide">더보기</span>+</a>
            </div>
        </div>
    </div>
</article>
<article class="main-contents inner-layer">
    <div class="main-menu-wrap">
        <a href="{{ route('board',['code'=>'photoPro']) }}" class="main-menu">
            <strong class="tit">포토갤러리</strong>
            <p>
                대한부정맥학회 포토갤러리 입니다.
            </p>
        </a>
        <a href="{{ route('board',['code'=>'replyPro']) }}" class="main-menu">
            <strong class="tit">자유게시판</strong>
            <p>
                자유게시판을 보실 수 있습니다.
            </p>
        </a>
    </div>
</article>

@endsection

@section('addScript')
@endsection