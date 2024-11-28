<!DOCTYPE html>
<html lang="vi">

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/styleBlog.css') }}">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    <script src="{{ asset('frontend/js/script_password.js') }}"></script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Kiểm tra nếu có thông báo thành công
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif
            // Kiểm tra nếu có thông báo lỗi
            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif
            // Cấu hình mặc định cho toastr (tuỳ chỉnh nếu cần)
            toastr.options = {
                "closeButton": true, // Hiển thị nút đóng
                "debug": false, // Tắt chế độ debug
                "newestOnTop": true, // Hiển thị thông báo mới nhất trên cùng
                "progressBar": true, // Hiển thị thanh tiến trình
                "positionClass": "toast-top-right", // Vị trí thông báo
                "preventDuplicates": false, // Không ngăn thông báo trùng lặp
                "onclick": null,
                "showDuration": "300", // Thời gian hiển thị (ms)
                "hideDuration": "1000", // Thời gian ẩn đi (ms)
                "timeOut": "5000", // Thời gian tự động đóng (ms)
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        });
    </script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '.delete-item', function(event) {
                event.preventDefault();

                let deleteUrl = $(this).attr('href');
                Swal.fire({
                    title: 'Bạn có chắc chắn không?',
                    text: "Bạn sẽ không thể hoàn tác hành động này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'DELETE',
                            url: deleteUrl,
                            success: function(data) {
                                console.log(data);
                                if (data.status == 'success') {
                                    Swal.fire(
                                        'Đã xóa!',
                                        data.message,
                                        'success'
                                    )
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        'Không thể xóa',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                console.log(error);
                            }
                        })
                    }
                })
            })
        })
    </script>
</body>

</html>
