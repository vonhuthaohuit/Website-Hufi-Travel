<div class="section-title text-center">
    <span class="section-title__tagline">Featured tours</span>
    <h2 class="section-title__title">Các tour du lịch phổ biến nhất</h2>
</div>
<div class="row">
    @for ($i = 0; $i < 8; $i++)
        <div class="owl-item col-6 col-lg-3 mb-4">
            <div class="popular-tours__single">
                <a href="{{ route('tour.detail') }}">
                    <div class="popular-tours__img">
                        <img src="{{ asset('frontend/images/popular-tours__img.png') }}" alt="">
                        <div class="popular-tours__icon">
                            <a href="{{ route('tour.detail') }}">
                                <i class="fa fa-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="popular-tours__content">
                        <a href="{{ route('tour.detail') }}">
                            <div class="popular-tours__stars">
                                <i class="fa fa-star"></i> 8.0 Superb
                            </div>
                            <h3 class="popular-tours__title"><a href="{{ route('tour.detail') }}">The Dark Forest
                                    Adventure</a></h3>
                            <p class="popular-tours__rate"><span>49.000.000đ</span> / Một người</p>
                        </a>

                    </div>
                </a>
            </div>
        </div>
    @endfor
</div>
