@extends('layouts.web-layout')

@section('addStyle')
    <style>
        #round_banner {position: fixed; left: 30px; bottom: 70px; height: 71.7px; z-index: 3;}
        #round_banner .roulette_btn {position: absolute; left: 0; top: 0; line-height: 1.3; border-radius: 71.7px; height: 100%; font-size: 14px; display: flex; justify-content: center; align-items: center; overflow: hidden;}
        #round_banner .roulette_btn:nth-child(1) {width: 71.7px; background: #A8C8F9; z-index: 1; text-align: center; color: #fff; box-shadow: 4px 4px 4px #eee; text-shadow: 1px 1px 3px #777; cursor: pointer;}
        #round_banner .roulette_btn:nth-child(2) {width: 300px; background: rgba(255,255,255,.7); border: 3px solid #eee; transform-origin: 0 50%; transform: scale(0); transition: .3s; z-index: 0; text-indent: 71.7px; text-align: left;}
        #round_banner .roulette_btn:nth-child(1):hover +.roulette_btn:nth-child(2) {transform: scale(1);}

        #round_banner #show_roulette {position: fixed; width: 100%; height: 100%; top: 0; left: 0; background: rgba(0,0,0,.9); transform: scale(0); transition: .3s; z-index: 1;}
        #round_banner #title {color: #fff; font-size: 16px; line-height: 33px; width: 100%; text-align: center; padding-top: 50px;}
        #round_banner #title:first-line {font-weight: bold; font-size: 40px;}
        #round_banner #count::before {content: '나의 응모기회 :'; margin-right: 7px;}
        #round_banner #count {width: 100%; height: 50px; background: #e89f32; color: #000; display: flex; justify-content: center; align-items: center; font-size: 18px;}
        #round_banner #roulette {text-align: center; position: relative; margin-top: 50px;}
        #round_banner #roulette::after {content: ''; position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 0; height: 0; border-top: 70px solid #d6000f; border-right: 20px solid transparent; border-bottom: 0px solid transparent; border-left: 20px solid transparent; border-radius: 20px;}
        #round_banner #start {color: gold; border: 5px solid gold; padding: 10px 0; background: #000; font-size: 20px; font-weight: bold; width: 200px; position: absolute; top: 0; left: 50%; transform: translateX(-50%) translateY(-70%); cursor: pointer; z-index: 1;}
        #round_banner #description {margin-left: 50%; transform: translateX(-50%); width: 500px;}
        #round_banner #description li {color: #fff; font-size: 16px; line-height: 21px;}
        #round_banner #description li::first-letter {color: #d6000f;}
        #round_banner #description >div {height: 50px; width: 100%; background: gold; color: #000; border: 1px solid #fff; font-size: 20px; display: flex; justify-content: center; align-items: center; margin: 20px 0;}
        #round_banner #close {position: absolute; right: 50px; top: 50px; width: 50px; height: 50px; background: #fff; color: #000; border: 3px solid #000; border-radius: 50px; display: flex; justify-content: center; align-items: center; font-size: 14px; font-weight: 900; cursor: pointer;}
        #round_banner #roulette >img {width: 100%; max-width: 622px;}
    </style>
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="ready-wrap">
                <img src="/assets/image/sub/img_ready.png" alt="">
                <strong class="tit">페이지 <span class="highlights text-red">준비중</span> 입니다.</strong>
                <p>
                    이용에 불편을 드려 대단히 죄송합니다. <br>
                    빠른 시일내에 준비하여 찾아뵙겠습니다.
                </p>
            </div>

            <div id="round_banner" class="draggable">
                <div class="roulette_btn">행운의<br>룰렛</div>
                <div class="roulette_btn">룰렛 돌리고 마일리지 적립!</div>
                <div id="show_roulette">
                    <div id="title">바이크마트: 행운의 룰렛 이벤트!<br>방문해주신 고객님 누구나 하루에 한번!</div>
                    <div id="count">0</div>
                    <div id="roulette">
                        <img src="/sgj_image/roulette.png">
                        <div id="start">START</div>
                    </div>
                    <div id="description">
                        <div>이벤트 안내</div>
                        <li>▨ 이벤트 기간은 3월 21일부터 3월 25일까지입니다.</li>
                        <li>▨ 회원 누구나 하루에 한번 참여 가능합니다.</li>
                        <li>▨ 당첨 여부와 포인트 적립은 즉시 확인하실 수 있습니다.</li>
                        <li>▨ 부정한 방법으로 획득한 마일리지는 취소될 수 있습니다.</li>
                    </div>
                    <div id="close">X</div>
                </div>
            </div>

        </div>

    </article>
@endsection

@section('addScript')
    <script>
        var roulette_data;
        var roulette_error = new Array(
            "에러 리스트",
            "회원만 이용가능한 서비스입니다.",
            "이벤트 기간이 아닙니다. \n3월 21일 ~ 3월 25일",
            "남은 응모기회가 없습니다.",
            "포인트 적립 실패. 응모횟수는 차감되지 않습니다."
        );
        $('#round_banner .roulette_btn').on({
            "click" : function() {
                $.ajax({
                    type: 'post',
                    url: '/sgj/roulette.php',
                    data: {'id': 'webmaster', 'state': 1},
                    datatype: 'json',
                    success: function(data) {
                        roulette_data = JSON.parse(data);
                        if(roulette_data.error) {alert(roulette_error[roulette_data.error]);}
                        else {
                            $('#round_banner #show_roulette #count').text(roulette_data.roulette);
                            $('#round_banner #show_roulette').css({'transform':'scale(1)'});
                        }
                    },
                    error: function(request, status, error) {console.log(request, status, error);}
                });
            }
        });
        $('#round_banner #close').on({
            "click" : function() {
                $('#round_banner #show_roulette').css({'transform':'scale(0)'});
            }
        });
        $('#round_banner #start').on({
            "click" : function() {
                $.ajax({
                    type: 'post',
                    url: '/sgj/roulette.php',
                    data: {'id': 'webmaster', 'state': 2},
                    datatype: 'json',
                    success: function(data) {
                        roulette_data = JSON.parse(data);
                        if(roulette_data.error) {alert(roulette_error[roulette_data.error]);}
                        else {
                            $('#round_banner #show_roulette #count').text(roulette_data.roulette-1);
                            $('#round_banner #roulette >img').css({
                                'transition': '3s cubic-bezier(0,1,0,1)',
                                'transform': 'rotate('+(3585+roulette_data.rotate)+'deg)'
                            });
                            $('#round_banner #roulette >img').one('transitionend webkitTransitionEnd oTransitionEnd otransitionend', function() {
                                alert(roulette_data.mileage+' 마일리지 당첨을 축하드립니다!');
                            });
                        }
                    },
                    error: function(request, status, error) {console.log(request, status, error);}
                });

                $('#round_banner #roulette >img').css({'transition': '', 'transform': ''});
            }
        });
    </script>
@endsection