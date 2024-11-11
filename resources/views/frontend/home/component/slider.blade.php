<section class="main-slider" style="margin-top: -120px;">
    <div class="swiper-container thm-swiper__slider"
        data-swiper-options='{"slidesPerView": 1, "loop": true, "effect": "fade", "pagination": {"el": "#main-slider-pagination", "type": "bullets", "clickable": true}, "navigation": {"nextEl": ".main-slider-button-next", "prevEl": ".main-slider-button-prev", "clickable": true}, "autoplay": {"delay": 5000}}'>
        <div class="swiper-wrapper">

            <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="0"
                style="width: 100%; transition-duration: 0ms; opacity: 1; transform: translate3d(-1519px, 0px, 0px);">
                <div class="image-layer"
                    style="background-image: url({{ asset('frontend/images/main-slider-1-1.png') }});">
                </div>
                <div class="image-layer-overlay"></div>
                <div class="container">
                    <div class="swiper-slide-inner">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2> Travel &amp; Adventures</h2>
                                <p>Chuyến đi mơ ước, nơi hành trình trở thành kỷ niệm!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="1"
                style="width: 100%; transition-duration: 0ms; opacity: 1; transform: translate3d(-3038px, 0px, 0px);">
                <div class="image-layer"
                    style="background-image: url({{ asset('frontend/images/main-slider-1-2.png') }});">
                </div>
                <div class="image-layer-overlay"></div>
                <div class="container">
                    <div class="swiper-slide-inner">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2> Travel &amp; Adventures</h2>
                                <p>Chuyến đi mơ ước, nơi hành trình trở thành kỷ niệm!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide swiper-slide-next" data-swiper-slide-index="2"
                style="width: 100%; transition-duration: 0ms; opacity: 0; transform: translate3d(-4557px, 0px, 0px);">
                <div class="image-layer"
                    style="background-image: url({{ asset('frontend/images/main-slider-1-3.png') }});">
                </div>
                <div class="image-layer-overlay"></div>
                <div class="container">
                    <div class="swiper-slide-inner">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2> Travel &amp; Adventures</h2>
                                <p>Chuyến đi mơ ước, nơi hành trình trở thành kỷ niệm!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-slide-index="0"
                style="width: 100%; transition-duration: 0ms; opacity: 0; transform: translate3d(-6076px, 0px, 0px);">
                <div class="image-layer"
                    style="background-image: url({{ asset('frontend/images/main-slider-1-1.png') }})">
                </div>
                <div class="image-layer-overlay"></div>
                <div class="container">
                    <div class="swiper-slide-inner">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2> Travel &amp; Adventures</h2>
                                <p>Chuyến đi mơ ước, nơi hành trình trở thành kỷ niệm!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide" data-swiper-slide-index="2">
                <div class="image-layer"
                    style="background-image: url('{{ asset('frontend/images/background.png') }}');">
                </div>
                <div class="image-layer-overlay"></div>
                <div class="container">
                    <div class="swiper-slide-inner">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2>Travel &amp; Adventures</h2>
                                <p>Chuyến đi mơ ước, nơi hành trình trở thành kỷ niệm!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-slider-nav">
            <div class="main-slider-button-prev" role="button" aria-label="Previous slide"><span
                    class="icon-right-arrow"></span></div>
            <div class="main-slider-button-next" role="button" aria-label="Next slide"><span
                    class="icon-right-arrow"></span></div>
        </div>
    </div>
</section>

@push('script')
    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', JSON.parse(document.querySelector('.swiper-container')
                .getAttribute('data-swiper-options')));
            swiper.update();
        });
    </script>
@endpush
