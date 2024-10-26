<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HUFI Travel</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tevily.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tevilyResponsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tevilyIcon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/swiper/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/animation/animation.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/animation/custom-animation.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body>
    @include('frontend.layouts.header')

    <main class="main-content">
        @yield('renderBody')
    </main>

    @include('frontend.layouts.footer')
    @include('frontend.layouts.component.abs-fixed')

    <script src="{{ asset('frontend/js/tevily.js') }}"></script>
    <script src="{{ asset('frontend/library/swiper/swiper.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script lang="javascript">
        var __vnp = {
            code: 23211,
            key: '',
            secret: '250244cc08e16354ae8cfb63f8ab00d0'
        };
        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.defer = true;
            ga.src = '//core.vchat.vn/code/tracking.js?v=28664';
            var s = document.getElementsByTagName('script');
            s[0].parentNode.insertBefore(ga, s[0]);
        })();
    </script>
</body>

</html>
