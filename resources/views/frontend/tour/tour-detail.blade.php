@extends('frontend.layouts.app')

@section('renderBody')
    @include('frontend.tour.component.slider.main-slider-detail')

    <section class="tour-details">
        <div class="tour-details__top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tour-details__top-inner">
                            <div class="tour-details__top-left">
                                <h2 class="tour-details__top-title">National Park 2 Days Tour</h2>
                                <p class="tour-details__top-rate"><span>$870</span> / Per Person</p>
                            </div>
                            <div class="tour-details__top-right">
                                <ul class="list-unstyled tour-details__top-list">
                                    <li>
                                        <div class="icon">
                                            <span class="icon-clock"></span>
                                        </div>
                                        <div class="text">
                                            <p>Khoảng thời gian</p>
                                            <h6>2 Ngày 1 Đêm</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-user"></span>
                                        </div>
                                        <div class="text">
                                            <p>Độ tuổi</p>
                                            <h6>12 +</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-plane"></span>
                                        </div>
                                        <div class="text">
                                            <p>Loại tour</p>
                                            <h6>Phiêu lưu, vui vẻ</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-place"></span>
                                        </div>
                                        <div class="text">
                                            <p>Địa điểm</p>
                                            <h6>Los Angeles</h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="tour-details__bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tour-details__bottom-inner">
                            <div class="tour-details__bottom-left">
                                <ul class="list-unstyled tour-details__bottom-list">
                                    <li>
                                        <div class="icon">
                                            <span class="icon-clock"></span>
                                        </div>
                                        <div class="text">
                                            <p>Posted 2 days ago</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="text">
                                            <p>8.0 Superb</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tour-details__bottom-right">
                                <a href="#"><i class="fas fa-share"></i>share</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mt-4 mb-3" style="font-weight: 700;"><b>Tổng quan</b></h3>
                <p style="text-align: justify; font-size: 16px;">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce
                    posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis
                    urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus. Pellentesque habitant morbi tristique
                    senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
                    Aenean nec lorem.
                    In porttitor. Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque at, vulputate vitae,
                    pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy. Fusce aliquet pede non
                    pede. Suspendisse dapibus lorem pellentesque magna. Integer nulla. Donec blandit feugiat ligula. Donec
                    hendrerit, felis et imperdiet euismod, purus ipsum pretium metus, in lacinia nulla nisl eget sapien.
                    Donec ut est in lectus consequat consequat. Etiam eget dui. Aliquam erat volutpat. Sed at lorem in nunc
                    porta tristique. Proin nec augue. Quisque aliquam tempor magna. Pellentesque habitant morbi tristique
                    senectus et netus et malesuada fames ac turpis egestas. Nunc ac magna. Maecenas odio dolor, vulputate
                    vel, auctor ac, accumsan id, felis. Pellentesque cursus sagittis felis.
                </p>

                <h3 class="mt-4 mb-3" style="font-weight: 700;"><b>Lịch trình</b></h3>
                <h5 class="mt-4 mb-3" style="font-weight: 700;">Ngày 1: HCM/HÀ NỘI – NARITA – NHẬT BẢN - BAY THẲNG</h5>
                <p style="text-align: justify; font-size: 16px;">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce
                    posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis
                    urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus. Pellentesque habitant morbi tristique
                    senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
                    Aenean nec lorem.
                    In porttitor. Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque at, vulputate vitae,
                    pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy. Fusce aliquet pede non
                    pede.
                </p>
                <img src="{{ asset('frontend/images/tour/tour-details-bg-1.png') }}" alt="" width="100%">

                <h5 class="mt-4 mb-3" style="font-weight: 700;">Ngày 2: HCM/HÀ NỘI – NARITA – NHẬT BẢN - BAY THẲNG</h5>
                <p style="text-align: justify; font-size: 16px;">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce
                    posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis
                    urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus. Pellentesque habitant morbi tristique
                    senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
                    Aenean nec lorem.
                    In porttitor. Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque at, vulputate vitae,
                    pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy. Fusce aliquet pede non
                    pede.
                </p>

                <h5 class="mt-4 mb-3" style="font-weight: 700;">Ngày 3: HCM/HÀ NỘI – NARITA – NHẬT BẢN - BAY THẲNG</h5>
                <p style="text-align: justify; font-size: 16px;">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce
                    posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis
                    urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus. Pellentesque habitant morbi tristique
                    senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
                    Aenean nec lorem.
                    In porttitor. Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque at, vulputate vitae,
                    pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy. Fusce aliquet pede non
                    pede.
                </p>

                <div class="comment-group">
                    <h4>Bình luận</h4>
                    <div class="comment-box">
                        <div class="comment-avatar">
                            <img src="{{ asset('frontend/images/icon/user.png') }}" alt="avatar">
                        </div>
                        <div class="comment-content">
                            <textarea placeholder="Để lại bình luận của bạn"></textarea>
                            <button type="submit">Gửi bình luận</button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h4>Tour tương tự</h4>
                    <a href="#" style="font-size: 13px;">Xem thêm</a>
                </div>


                <div class="row mt-3 mb-4">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="owl-item col-6 col-lg-4 mb-4">
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
                                            <h3 class="popular-tours__title"><a href="{{ route('tour.detail') }}">The Dark
                                                    Forest
                                                    Adventure</a></h3>
                                            <p class="popular-tours__rate"><span>49.000.000đ</span> / Một người</p>
                                        </a>

                                    </div>
                                </a>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-lg-4">
                <div class="table-responsive table-detail-info ">
                    <div class="form-group discount form-inline  ">
                        <div class="group-price-row">
                            <div class="price-old">54,900,000</div>
                            <div class="price-new">49,900,000</div>
                        </div>

                    </div>
                    <table class="table info-product">
                        <tbody>
                            <tr>
                                <td><b><i class="fa-solid fa-calendar-days"></i> Khởi hành:</b></td>
                                <td>17/11, 17/12/2024; 19/03/2025</td>
                            </tr>
                            <tr>
                                <td><b><i class="fa-regular fa-clock"></i> Thời gian: </b></td>
                                <td>2 Ngày - 1 Đêm</td>
                            </tr>
                            <tr>
                                <td><b><i class="fa-solid fa-road"></i> Phương tiện:</b></td>
                                <td>Máy bay</td>
                            </tr>
                            <tr>
                                <td><b><i class="fa-solid fa-money-bill-1-wave"></i> Giá:</b></td>
                                <td>49,900,000 VNĐ</td>
                            </tr>
                            <tr>
                                <td><b><span class="fa fa-phone"></span> Liên hệ tư vấn:</b></td>
                                <td>
                                    <div> 0899909145 (Sài Gòn) - 0896163969 (Hà Nội) </div>
                                </td>
                            </tr>
                            <tr>
                                <td><b><span class="fa fa-cubes"></span> Số chỗ còn nhận:</b></td>
                                <td>
                                    Liên hệ </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a class="btn btn-danger btn-lg btn-booking" href="#">
                                        Đặt tour
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--END: detail-info-->
                </div>
            </div>
        </div>
    </div>

    @include('frontend.home.component.bookNow')

    <style>
        .table-responsive {
            margin: 20px auto;
            max-width: 800px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            font-size: 14px;
            position: sticky;
            top: 180px;
            z-index: 1000;
        }

        .form-group {
            padding: 15px;
            background-color: #f9f9f9;
            border-bottom: 1px solid #ddd;
        }

        .per-discount {
            font-size: 1.5em;
            color: red;
        }

        .group-price-row {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .price-old {
            text-decoration: line-through;
            color: #999;
            margin-right: 10px;
        }

        .price-new {
            font-size: 1.5em;
            color: green;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .table td {
            border-bottom: 1px solid #ddd;
        }

        .table b {
            color: #333;
        }

        .btn-booking {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            color: #fff;
            background-color: var(--thm-primary);
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-booking:hover {
            background-color: #c9302c;
        }

        .social-plugin {
            margin: 15px 0;
            text-align: center;

        }

        .comment-box {
            display: flex;
            align-items: flex-start;
            margin: 20px 0;
        }

        .comment-group {
            padding: 10px;
            background-color: #f7f7f7;
        }

        .comment-avatar {
            margin-right: 10px;
        }

        .comment-avatar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .comment-content {
            flex: 1;
        }

        .comment-content textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            resize: none;
            height: 80px;
            margin-bottom: 10px;
            color: #777;
        }

        .comment-content textarea::before {
            border: 1px solid #adadad;
        }

        .comment-content button {
            background-color: #339af0;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .comment-content button:hover {
            background-color: #228be6;
        }
    </style>
@endsection
