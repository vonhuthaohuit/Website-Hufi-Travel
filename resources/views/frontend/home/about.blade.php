@extends('frontend.layouts.app')

@section('renderBody')
    <section class="page-header">
        <div class="page-header__top">
            <div class="page-header-bg">
            </div>
            <div class="page-header-bg-overly"></div>
            <div class="container">
                <div class="page-header__top-inner">
                    <h2>Giới thiệu</h2>
                </div>
            </div>
        </div>
        <div class="page-header__bottom">
            <div class="container pt-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>


    <div class="services">
        <div class="container-xl">
            <section class="about-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="about-page__left">
                                <div class="about-page__img">
                                    <img src="{{ asset('frontend/images/about-page.png') }}" alt="HUFI Travel">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="about-page__right">
                                <div class="section-title text-left">
                                    <span class="section-title__tagline">Learn about us</span>
                                    <h2 class="section-title__title">Cùng khám phá cùng HUFI Travel</h2>
                                </div>
                                <p class="about-page__text-1">A Simply Perfect Place to Get Lost</p>
                                <p class="about-page__text-2">We are trusted by our clients and have a reputation for the
                                    best services in the field. Lorem ipsum is simply free text dolor sit amett consectetur
                                    adipiscing elit. It is a long established fact that a reader will be distracted by the
                                    readable content of a page.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="row">
                <div class="service-item col-lg-4">
                    <img src="{{ asset('frontend/images/icon/target.png') }}" alt="Mục tiêu">
                    <h3>MỤC TIÊU</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                        laoreet
                        dolore magna aliquam erat volutpat.</p>
                </div>
                <div class="service-item col-lg-4">
                    <img src="{{ asset('frontend/images/icon/mission.png') }}" alt="Sứ mệnh">
                    <h3>SỨ MỆNH</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                        laoreet
                        dolore magna aliquam erat volutpat.</p>
                </div>
                <div class="service-item col-lg-4">
                    <img src="{{ asset('frontend/images/icon/telescope.png') }}" alt="Tương lai">
                    <h3>TƯƠNG LAI</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                        laoreet
                        dolore magna aliquam erat volutpat.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="video-two">
        <div class="video-two-bg jarallax" data-jarallax="" data-speed="0.2" data-imgposition="50% 0%"
            style="background-image: none;"
            data-jarallax-original-styles="background-image: url({{ asset('frontend/images/video-one-two-bg.png') }})">
            <div id="jarallax-container-0"
                style="position: absolute; top: 300px; left: 0px; width: 100%; height: 100%; overflow: hidden; z-index: -100;">
                <div
                    style="background-position: 50% 50%; background-size: cover; background-repeat: no-repeat; background-image: url(&quot;https://tevily-html.vercel.app/assets/images/backgrounds/video-one-two-bg.jpg&quot;); position: fixed; top: 0px; left: 0px; width: 1519.2px; height: 800px; overflow: hidden; pointer-events: none; transform-style: preserve-3d; backface-visibility: hidden; will-change: transform, opacity; margin-top: -33.9px; transform: translate3d(0px, 68.14px, 0px);">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="video-two__inner">
                        <div class="video-one__video-link">
                            <a href="https://www.youtube.com/watch?v=khX07LV25Kc" class="video-popup">
                                <div class="video-one__video-icon">
                                    <span class="icon-play-button"></span>
                                    <i class="ripple"></i>
                                </div>
                            </a>
                        </div>
                        <p class="video-one__tagline">Bạn đã sẵn sàng để đi du lịch chưa?</p>
                        {{-- <h2 class="video-one__title">Tevily is a World Leading <br> Online Tour Booking Platform
                        </h2> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.home.component.bookNow')



    <style>
        .backgroud-about {
            background-color: #ff6a00;
            color: #fff;
            text-align: center;
            width: 100%;
            height: 300px;
        }

        .backgroud-about h1 {
            font-size: 2em;
            font-weight: bold;
        }

        .backgroud-about p {
            font-size: 1em;
            margin-top: 10px;
        }

        /* Phần dịch vụ */
        .services {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            background-color: #f9f9f9;
        }

        .service-item {
            text-align: center;
            /* width: 200px;
                                        margin: 0 20px; */
        }

        .service-item img {
            width: 80px;
            height: 80px;
        }

        .service-item h3 {
            font-size: 1.2em;
            margin: 15px 0;
            font-weight: bold;
        }

        .service-item p {
            font-size: 0.9em;
            color: #666;
            line-height: 1.5;
        }
    </style>
@endsection
