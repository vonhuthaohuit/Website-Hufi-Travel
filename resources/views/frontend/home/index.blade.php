<div>
    <div class="w-100" style="position: relative;">
    </div>
    @include('frontend.home.component.slider')

    @include('frontend.home.component.search')
    <div class="container-xl">

        @include('frontend.home.component.destination')

        @include('frontend.home.component.aboutOne')
        @include('frontend.home.component.toursPopular')

    </div>
    @include('frontend.home.component.chooseTourType')

    @include('frontend.home.component.whyChoose')

    @include('frontend.home.component.blogsSuggestHomePage')

    @include('frontend.home.component.bookNow')
</div>

@push('style')
    <style>
        .border-radius-top-left-right {
            border-top-left-radius: 9999px;
            border-top-right-radius: 9999px;
            height: 50px;
            background-color: rgba(255, 255, 255, 1.00);
            margin-top: -50px;
            z-index: 1;
            position: absolute;
            left: 0;
            right: 0;
        }

        .banner-thumb {
            position: absolute;
            top: 130px;
            width: 100%;
        }

        .banner-slogan {
            display: flex;
            justify-content: center;
            width: 100%;
            font-size: 28px;
            color: #fff;
            font-weight: 700;
        }

        .nav-tabs .nav-link.active {
            border-radius: 9999px;
            margin-bottom: 8px;
        }

        .nav-tabs .nav-link.active svg path {
            fill: #000;
            stroke: #000;
        }

        .nav-tabs .nav-link {
            color: #fff;
            font-weight: 700;
            margin: 0 10px 0 10px;
            border-radius: 9999px;
        }

        .nav-tabs .nav-link:hover {
            border-radius: 9999px;
        }
    </style>
@endpush
