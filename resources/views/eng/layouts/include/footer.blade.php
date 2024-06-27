<footer id="footer">
    <div class="footer-wrap inner-layer">
                <span class="footer-logo">
                    <a href="/"><img src="/html/eng/assets/image/main/footer_logo.png" alt="대한부정맥학회 Korean Heart Rhythm Society"></a>
                </span>
        <div class="footer-con">
            <p>
                Korean Heart Rhythm Society Secretariat <br>
                (04323) 1604, Block A, 372, Hangang-daero, Yongsan-gu, Seoul
            </p>
            <ul>
                <li>
                    <strong>TEL.</strong> <a href="tel:+82.2-318-5416" target="_blank">+82.2-318-5416</a>
                </li>
                <li>
                    <strong>FAX.</strong> +82-2-318-5417
                </li>
                <li>
                    <strong>E-mail.</strong> <a href="mailto:khrs@k-hrs.org" target="_blank">khrs@k-hrs.org</a>
                </li>
            </ul>
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