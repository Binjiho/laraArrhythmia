@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')

            <article class="sub-contents">
                <div class="sub-conbox inner-layer">
                    <div class="research-tit-wrap branch">
                        <h3 class="research-tit">지회</h3>
                    </div>

                    <div class="img-wrap text-center scroll-x touch-help">
                        <div><img src="/assets/image/sub/img_branch.png" alt="호남지회, 대구경북지회, 부산울산경남지회"></div>
                    </div>
                </div>
            </article>
		</div>
	</article>
@endsection

@section('addScript')

@endsection