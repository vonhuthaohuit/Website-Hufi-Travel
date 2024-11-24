<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tevily.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tevilyResponsive.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tevilyIcon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/animation/animation.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/animation/custom-animation.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/styleTour.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/styleHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/styleSearch.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/styleFooter.css') }}">
    @stack('style')
</head>

<body class="{{ Route::currentRouteName() }}">
    @include('frontend.layouts.header')

    <main class="main-content">
        @yield('renderBody')
    </main>

    @include('frontend.layouts.footer')
    @include('frontend.layouts.component.abs-fixed')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend/js/tevily.js') }}"></script>
    <script src="{{ asset('frontend/library/swiper/swiper.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    @stack('script')
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
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        @if (session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000, // Thời gian hiển thị (miliseconds)
                close: true, // Có hiển thị nút đóng không
                gravity: "top", // Vị trí hiển thị (top, bottom)
                position: 'right', // Vị trí bên trái hay bên phải
                backgroundColor: "blue", // Màu nền
                stopOnFocus: true, // Dừng khi hover chuột
            }).showToast();
            @php
                session()->forget('success');
            @endphp
        @endif
    </script>

</body>

</html>
