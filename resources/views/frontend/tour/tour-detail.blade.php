@extends('frontend.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/slickCarousel.css') }}">
@endpush

@section('renderBody')
    @include('frontend.tour.component.slider.main-slider-detail')

    <section class="tour-details">
        <div class="tour-details__top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tour-details__top-inner row">
                            <div class="tour-details__top-left col-lg-5">
                                <h2 class="tour-details__top-title">{{ $tour->tentour }}</h2>
                                <p class="tour-details__top-rate"><span>{{ number_format($tour->giatour) }}đ</span> /
                                    Một người</p>
                            </div>
                            <div class="tour-details__top-right col-lg-7">
                                <ul class="list-unstyled tour-details__top-list">
                                    <li>
                                        <div class="icon">
                                            <span class="icon-clock"></span>
                                        </div>
                                        <div class="text">
                                            <p>Khoảng thời gian</p>
                                            <h6>{{ $tour->thoigiandi }}</h6>
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
                                            <h6>{{ $tour->tenloai }}</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-place"></span>
                                        </div>
                                        <div class="text">
                                            <p>Địa điểm</p>
                                            <h6>{{ $tour->tendiemdulich }}</h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tour-details__bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tour-details__bottom-inner">
                            <div class="tour-details__bottom-left">
                                <ul class="list-unstyled tour-details__bottom-list">
                                    {{-- <li>
                                        <div class="icon">
                                            <span class="icon-clock"></span>
                                        </div>
                                        <div class="text">
                                            <p>Posted 2 days ago</p>
                                        </div>
                                    </li> --}}
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
                                <a href="#"><i class="fas fa-share"></i>chia sẻ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mt-4 mb-3">{!! $tour->tieude !!}</h3>
                {!! $tour->mota !!}

                @include('frontend.tour.component.tour-note')

                <div class="comment-group-box">
                    <h4>Bình luận</h4>
                    {{-- <div class="comment-box">
                        <div class="comment-avatar">
                            <img src="{{ asset('frontend/images/icon/user.png') }}" alt="avatar">
                        </div>
                        <div class="comment-content">
                            <textarea placeholder="Để lại bình luận của bạn"></textarea>
                            <button type="submit">Gửi bình luận</button>
                        </div>
                    </div> --}}
                    <button class="btn-create-comment">Thêm đánh giá</button>
                    @include('frontend.tour.comment.createComment')
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                    <h4>Tour tương tự</h4>
                    <a href="{{ route('tour.all-tour') }}" style="font-size: 13px;">Xem thêm</a>
                </div>

                <div class="row slick-slider">
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
                                            <div class="popular-tours__stars">
                                                <i class="fa fa-star"></i> 8.0 Superb
                                            </div>
                                            <h3 class="popular-tours__title"><a
                                                    href="{{ route('tour.detail', $item->slug) }}">{{ $item->tentour }}</a>
                                            </h3>

                                            <p class="popular-tours__rate">
                                                <span>{{ number_format($item->giatour) }}đ</span> / Một người
                                            </p>
                                        </a>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
            <div class="col-lg-4">
                <div class="table-responsive table-detail-info ">
                    <div class="form-group discount form-inline  ">
                        <div class="group-price-row">
                            {{-- <div class="price-old">54,900,000</div> --}}
                            <div class="price-new">{{ number_format($tour->giatour) }}đ</div>
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
                                <td>{{ number_format($tour->giatour) }} VNĐ</td>
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
                                    <a class="btn btn-danger btn-lg btn-booking" href="#" onclick="submitBookingForm(<?php echo 1 ?>)">Đặt tour</a>
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
    <script> // Lấy ra tour id khi bấm đặt tour
        function submitBookingForm(tourId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('tour.dattour') }}";

            const csrfTokenInput = document.createElement('input');
            csrfTokenInput.type = 'hidden';
            csrfTokenInput.name = '_token';
            csrfTokenInput.value = "{{ csrf_token() }}";
            form.appendChild(csrfTokenInput);

            const tourIdInput = document.createElement('input');
            tourIdInput.type = 'hidden';
            tourIdInput.name = 'tourid';
            tourIdInput.value = tourId;
            form.appendChild(tourIdInput);

            document.body.appendChild(form);
            form.submit();
        }
    </script>

    @push('script')
        <script type="text/javascript">
            $(document).ready(function() {
                $('.slick-slider').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    arrows: true,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
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
@endsection
