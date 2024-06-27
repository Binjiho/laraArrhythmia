<footer id="footer">
    <div class="footer-wrap inner-layer wide">
                <span class="footer-logo">
                    <a href="/"><img src="/assets/image/common/footer_logo.png" alt="대한부정맥학회 Korean Heart Rhythm Society"></a>
                </span>
        <div class="footer-con">
            <ul class="footer-menu">
                <li><a href="/auth/privacy?type=executive">개인정보 취급방침</a></li>
                <li><a href="#email" class="js-pop-open">이메일 무단 수집 거부</a></li>
            </ul>
            <p>(우)04323 서울시 용산구 한강대로 372 센트레빌아스테리움 서울 A동 1604호</p>
            <ul>
                <li>
                    <strong>TEL.</strong> <a href="tel:02-318-5416" target="_blank">02-318-5416</a>
                </li>
                <li>
                    <strong>FAX.</strong> 02-318-5417
                </li>
                <li>
                    <strong>E-mail.</strong> <a href="mailto:khrs@k-hrs.org" target="_blank">khrs@k-hrs.org</a>
                </li>
                <li>
                    <strong>대표자.</strong> 차태준
                </li>
                <li>
                    <strong>사업자등록번호.</strong> 227-82-66511
                </li>
            </ul>
            <p class="copy">Copyright &copy; 대한부정맥학회. All Rights Reserved.</p>
        </div>
    </div>

    <!-- 이메일 무단 수집 거부 popup -->
    <div class="popup-wrap" id="email" style="display: none;">
        <div class="popup-contents">
            <div class="popup-header">
                <img src="/assets/image/common/h1_logo_on.png" alt="대한부정맥학회 Korean Heart Rhythm Society.">
            </div>
            <div class="popup-conbox">
                <div class="popup-tit-wrap">
                    <h3 class="popup-tit">
                        <img src="/assets/image/common/ic_popup_email.png" alt=""> 이메일 무단 수집 거부
                    </h3>
                </div>
                <p>
                    대한부정맥학회는 정보통신망법 제50조의 2, 제50조의 7 등에 의거하여, 대한부정맥학회가 운영,관리하는 웹페이지상에서, 이메일 주소 수집 프로그램이나 그 밖의 기술적 장치 등을 이용하여 이메일 주소를 무단으로 수집하는 행위를 거부합니다. <br><br>
                    <strong>[게시일 2024년 02월 01일]</strong>
                </p>
                <div class="btn-wrap text-center">
                    <a href="#n" class="btn btn-type1 color-type1 js-pop-close">확인 <img src="/assets/image/common/ic_btn_arrow.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.js-pop-open').on('click',function(e){
            var popCnt = $(this).attr('href');
            $('html, body').addClass('ovh');
            $("#email").css('display','flex');
            return false;
        });
        $('.js-pop-close').on('click',function(e){
            $('html, body').removeClass('ovh');
            $(this).parents('.popup-wrap').css('display','none');
            return false;
        });
        $('.popup-wrap#email').off().on('click', function (e){
            if ($('.popup-contents').has(e.target).length == 0){
                $('html, body').removeClass('ovh');
                $('.popup-wrap').css('display','none');
            }
        });
    </script>
</footer>