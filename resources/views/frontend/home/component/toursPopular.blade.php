<div class="section-title text-center">
    <span class="section-title__tagline">Featured tours</span>
    <h2 class="section-title__title">Các tour du lịch phổ biến nhất</h2>
</div>
<div class="destinations-two-shape wow slideInLeft animated" data-wow-delay="100ms" data-wow-duration="2500ms"
    style="visibility: visible; animation-duration: 2500ms; animation-delay: 100ms; animation-name: slideInLeft;">
    <img src="{{ asset('frontend/images/destinations-two-shape.png') }}" alt="">
</div>
<div class="row slick-slider-tour-popular">
    @foreach ($tours as $item)
        <div class="owl-item col-6 col-lg-3 mb-4">
            <div class="popular-tours__single">
                <a href="{{ route('tour.detail', $item->slug) }}">
                    <div class="popular-tours__img">
                        <img src="{{ asset($item->hinhdaidien) }}" alt="{{ $item->tentour }}">
                        <div class="popular-tours__icon">
                            <a href="{{ route('tour.detail', $item->slug) }}">
                                <i class="fa fa-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="popular-tours__content">
                        <a href="{{ route('tour.detail', $item->slug) }}">
                            <h3 class="popular-tours__title"><a
                                    href="{{ route('tour.detail', $item->slug) }}">{{ $item->tentour }}</a></h3>

                            @php
                                $soSaoNguyen = floor($item->avg_rating);
                                $soSaoDu = $item->avg_rating - $soSaoNguyen;
                                $soSaoTrong = 5 - $soSaoNguyen - ($soSaoDu >= 0.5 ? 1 : 0);
                            @endphp

                            <div class="popular-tours__stars mb-2">
                                @if (!empty($item->avg_rating))
                                    @for ($i = 1; $i <= $soSaoNguyen; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor

                                    @if ($soSaoDu >= 0.5)
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    @endif

                                    @for ($i = 1; $i <= $soSaoTrong; $i++)
                                        <i class="fa-regular fa-star"></i>
                                    @endfor
                                @else
                                @endif
                            </div>

                            @if (empty($item->makhuyenmai))
                                <p class="popular-tours__rate">
                                    <span>{{ number_format($item->giatour) }}đ</span>
                                </p>
                            @else
                                <p class="popular-tours__rate">
                                    <span><del class="original-price">{{ number_format($item->giatour) }}đ</del>
                                        {{ number_format($item->giatourgiam) }}đ</span>
                                </p>
                            @endif
                        </a>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>

@push('style')
    <style>
        .slick-prev,
        .slick-next {
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .slick-prev {
            left: -33px;
        }

        .slick-next {
            right: -33px;
        }

        .slick-next::before,
        .slick-prev::before {
            font-size: 60px;
            color: #a9a9a9;
        }

        .slick-slide {
            padding: 10px;
        }

        .slick-slide {
            padding: 10px;
        }

        @media (max-width: 767px) {
            .slick-prev {
                left: 25px;
            }

            .slick-next {
                right: 25px;
            }
        }
    </style>
@endpush

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.slick-slider-tour-popular').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                arrows: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        });
    </script>
@endpush
