$(function (e) {
	$width = $(window).innerWidth(),
    wWidth = windowWidth();

	$(document).ready(function (e) {
        btnTop();
        mainVisual();
        mainQuickMenu();
        noticeRolling();
        videoRolling();
        sponsorBanner();
        fileUpload();
        popup();
        datepicker();     
        imgMap();

		if(wWidth < 1025){		
		}else{
		}
		
		resEvt();
	});

	// resize
	function resEvt() {	   
		if (wWidth < 1025) {
			mGnb();		
			subConHeight();
			subMenu();
			mTabMenu();

			if($('.js-dim').hasClass('mobile')){
				$('.js-dim').show();
				$('html, body').addClass('ovh');
			}     
			
		} else {		
            gnb();	
			tabMenu();
			if($('.js-dim').hasClass('mobile')){
				$('.js-dim').hide();
				$('html, body').removeClass('ovh');
			}
            $('.js-gnb > li > div').removeAttr('style');
            $('.js-sub-menu-list ul').removeAttr('style');
			$('.js-tab-menu, .js-tabcon-menu').removeAttr('style');		
			$('.js-btn-tab-menu').removeClass('on');
			$('body').off('click');
		}

		if(wWidth < 769){
			touchHelp();
		}
	}

	$(window).resize(function (e) {
		$width = $(window).innerWidth(),
		wWidth = windowWidth();
		resEvt();
	});

	$(window).scroll(function(e){
		if($(this).scrollTop() > 200){
			$('.js-btn-top').addClass('on');
		}else{
			$('.js-btn-top').removeClass('on');
		}
	});
});

function Mobile() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

function windowWidth() {
	if ($(document).innerHeight() > $(window).innerHeight()) {
		if (Mobile()) {
			return $(window).innerWidth();
		} else {
			return $(window).innerWidth() + 17;
		}
	} else {
		return $(window).innerWidth();
	}
}

function subConHeight(){
    $(document).ready(function(e){
        var subConHeight = $(window).outerHeight() - $('.js-header').outerHeight() - $('#footer').outerHeight();
        setTimeout(function(e){
            $('.sub-contents').css('min-height',subConHeight);
        },100);
    });	
}

function gnb(){
    $('.js-gnb > li > a').off('click');
    $('.js-gnb > li').on('mouseenter',function(e){
        $('.js-header').addClass('active');
        $(this).children('a').next('div').css({'display':'flex', 'opacity':1});
        $(this).siblings().children('a').next('div').css({'display':'none', 'opacity':0});
    });
    $('.js-header').on('mouseleave',function(e){
        $('.js-header').removeClass('active');
        $('.js-gnb > li > a + div').css({'display':'none', 'opacity':0});
    });
}

function mGnb() {
    $('.js-gnb > li').off('mouseenter');
    $('.js-header').off('mouseleave');
	$('.js-btn-menu-open').on('click', function (e) {
		$('.js-dim').addClass('mobile').show();
		$('.gnb-wrap').stop().animate({ 'right': 0 }, 400);
		$('html, body').addClass('ovh');
		return false;
	});
	$('.js-btn-menu-close, .js-dim').on('click', function (e) {
		$('.js-dim').removeClass('mobile').stop().hide();
		$('.gnb-wrap').stop().animate({ 'right': '-100%' }, 400);
		$('html, body').removeClass('ovh');
		return false;
	});
    $('.js-gnb > li > a').off().on('click',function(e){
        if($(this).next('div').length){
            $(this).parent('li').toggleClass('on');
            $(this).next('div').stop().slideToggle();
            $('.js-gnb > li > a').not(this).parent('li').removeClass('on');
            $('.js-gnb > li > a').not(this).next('div').stop().slideUp();
            return false;
        }
    });
}

function mainVisual(){
    $('.js-main-visual').not('.slick-initialized').slick({
        arrows: true,
        prevArrow: $('.btn-visual-prev'),
        nextArrow: $('.btn-visual-next'),
        dots: true,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 1000,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
    });
}

function mainQuickMenu(){
    $('.js-quick-menu').not('.slick-initialized').slick({
        arrows: true,
        prevArrow: $('.btn-rolling-prev'),
        nextArrow: $('.btn-rolling-next'),
        dots: false,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        cssEase: 'linear',
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        }]
    });
}

function noticeRolling(){
    $('.js-notice-rolling').not('.slick-initialized').slick({
        arrows: true,
        prevArrow: $('.main-board-wrap .btn-rolling-prev'),
        nextArrow: $('.main-board-wrap .btn-rolling-next'),
        dots: false,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        cssEase: 'linear',
        responsive: [
            {
            breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }
            ,{
            breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
        ]
    });
}

function videoRolling(){
    if($('.video-rolling-wrap').length){
        var swiper = new Swiper(".video-rolling-wrap .swiper-container", {
            centeredSlides: false,
            slidesPerView: 1,  
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 5000,
            },
            loop: true,
            navigation: {
                nextEl: '.video-rolling-wrap .btn-rolling-next',
                prevEl: '.video-rolling-wrap .btn-rolling-prev',
            },
            breakpoints: {        
                768: {                  
                    slidesPerView: 5,
                    centeredSlides: true,
                    effect: 'coverflow',  
                    coverflow: {
                        rotate: 0,
                        stretch: 100,
                        depth: 150,
                        modifier: 1.5,
                        slideShadows : false,
                    },
                }
            },
        });
    }
}

function sponsorBanner(){
    if($('.js-sponsor-rolling a').length > 4){
        $('.js-sponsor-rolling').not('.slick-initialized').slick({
            arrows: true,
            dots: false,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            cssEase: 'linear',
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }]
        });
    } 
}

function subMenu() {
	$('.js-btn-sub-menu').off().on('click', function (e) {
		$(this).next('ul').stop().slideToggle();
		$(this).toggleClass('on');
		return false;
	});
	$('body').off().on('click', function (e){
		if ($('.js-sub-menu-wrap').has(e.target).length == 0){
			$('.js-btn-sub-menu').removeClass('on');
			$('.js-btn-sub-menu:visible +  ul').stop().slideUp();
		}
	});
}

function tabMenu(){
    $('.js-btn-tab-menu').off('click');
    tabConMenu();
}

function tabConMenu(){
    $('.js-tabcon-menu > li').off().on('click',function(e){
        var cnt = $(this).index();
        $(this).addClass('on');
        $(this).siblings().removeClass('on');
        $('.js-tab-con').hide().eq(cnt).stop().fadeIn();
        return false;
    });
}

function mTabMenu(){
    $('.js-btn-tab-menu').each(function(e){
        var activeTab = $(this).next('ul').children('li.on').children('a').html();
        $(this).html(activeTab);
        $(this).off().on('click',function(e){
            $(this).toggleClass('on');
            $(this).next('ul').stop().slideToggle();
            $('.js-btn-tab-menu').not(this).removeClass('on');
            $('.js-btn-tab-menu').not(this).next('ul').stop().slideUp();
            return false;
        });
    });
    $('.js-tabcon-menu > li').off().on('click',function(e){     
        var activeTab = $(this).text();
        var cnt = $(this).index();
        $('.js-btn-tab-menu').text(activeTab);
        $(this).addClass('on');
        $(this).siblings().removeClass('on');
        $('.js-tab-con').hide().eq(cnt).stop().fadeIn();   
        $('.js-btn-tab-menu').removeClass('on');
        if($(this).parent().prev('.js-btn-tab-menu').length){
            $('.js-tabcon-menu').stop().slideUp();
        }
    });
}

function btnTop(){
	$('.js-btn-top').on('click',function(e){
	  $('html, body').stop().animate({'scrollTop':0},400);
		return false;
	});
}

function touchHelp(){
	$('.scroll-x').each(function(e){
		if($(this).height() < 180){
			$(this).addClass('small');
		}
		$(this).scroll(function(e){
			$(this).removeClass('touch-help');
		});
	});
}

function fileUpload(option=null){
    $('.file-upload').each(function(e){
        $(this).parent().find('.upload-name').attr('readonly','readonly');
        $(this).on('change',function(){
            var fileName = $(this).val();
            $(this).parent().find('.upload-name').val(fileName);
        });
    });
}

function popup(){
    $('.js-pop-open').on('click',function(e){
        var popCnt = $(this).attr('href');
        $('html, body').addClass('ovh');
        $(popCnt).css('display','flex');
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
}

function datepicker(){
	if($('.datepicker').length){
		$('.datepicker').datepicker({
			dateFormat : "yy-mm-dd",
			dayNamesMin : ["월", "화", "수", "목", "금", "토", "일"],
			monthNamesShort : ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
			showMonthAfterYear: true, 
			changeMonth : true,
			changeYear : true
		});
	}
}

function imgMap(){
    if($('img[usemap]').length){
		$('img[usemap]').rwdImageMaps();
	}
}