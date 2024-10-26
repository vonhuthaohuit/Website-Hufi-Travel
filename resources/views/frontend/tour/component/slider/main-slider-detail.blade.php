<section class="main-slider tour-details-slider">
    <div class="swiper-container thm-swiper__slider swiper-container-fade swiper-container-initialized swiper-container-horizontal"
        data-swiper-options="{&quot;slidesPerView&quot;: 1, &quot;loop&quot;: true,
&quot;effect&quot;: &quot;fade&quot;,
&quot;pagination&quot;: {
&quot;el&quot;: &quot;#main-slider-pagination&quot;,
&quot;type&quot;: &quot;bullets&quot;,
&quot;clickable&quot;: true
},
&quot;navigation&quot;: {
&quot;nextEl&quot;: &quot;.main-slider-button-next&quot;,
&quot;prevEl&quot;: &quot;.main-slider-button-prev&quot;,
&quot;clickable&quot;: true
},
&quot;autoplay&quot;: {
&quot;delay&quot;: 5000
}}">

        <div class="swiper-wrapper" style="transition-duration: 300ms;">
            <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="2"
                style="width: 100%; transition-duration: 300ms; opacity: 1; transform: translate3d(0px, 0px, 0px);">
                <div class="image-layer"
                    style="background-image: url({{ asset('frontend/images/tour/tour-details-bg-3.png') }});">
                </div>
                <div class="container">
                    <div class="swiper-slide-inner">
                        <div class="tour-details-slider_icon">
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="0"
                style="width: 100%; transition-duration: 300ms; opacity: 1; transform: translate3d(-1430px, 0px, 0px);">
                <div class="image-layer"
                    style="background-image: url({{ asset('frontend/images/tour/tour-details-bg-1.png') }});"></div>
                <div class="container">
                    <div class="swiper-slide-inner">
                        <div class="tour-details-slider_icon">
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="1"
                style="width: 100%; transition-duration: 300ms; opacity: 1; transform: translate3d(-2860px, 0px, 0px);">
                <div class="image-layer"
                    style="background-image: url({{ asset('frontend/images/tour/tour-details-bg-2.png') }});"></div>
                <div class="container">
                    <div class="swiper-slide-inner">
                        <div class="tour-details-slider_icon">
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide swiper-slide-next" data-swiper-slide-index="2"
                style="width: 100%; transition-duration: 300ms; opacity: 0; transform: translate3d(-4290px, 0px, 0px);">
                <div class="image-layer"
                    style="background-image: url({{ asset('frontend/images/tour/tour-details-bg-3.png') }});"></div>
                <div class="container">
                    <div class="swiper-slide-inner">
                        <div class="tour-details-slider_icon">
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-slide-index="0"
                style="width: 100%; transition-duration: 300ms; opacity: 0; transform: translate3d(-5720px, 0px, 0px);">
                <div class="image-layer"
                    style="background-image: url({{ asset('frontend/images/tour/tour-details-bg-1.png') }});"></div>
                <div class="container">
                    <div class="swiper-slide-inner">
                        <div class="tour-details-slider_icon">
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-slider-nav">
            <div class="main-slider-button-prev" tabindex="0" role="button" aria-label="Previous slide"><span
                    class="icon-right-arrow"></span></div>
            <div class="main-slider-button-next" tabindex="0" role="button" aria-label="Next slide"><span
                    class="icon-right-arrow"></span> </div>
        </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            loop: true,
            effect: 'fade',
            pagination: {
                el: '#main-slider-pagination',
                type: 'bullets',
                clickable: true,
            },
            navigation: {
                nextEl: '.main-slider-button-next',
                prevEl: '.main-slider-button-prev',
                clickable: true,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
        swiper.update();
    });
</script>
