@extends('frontend.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/slickCarousel.css') }}">

    <style>
        #content p {
            text-align: justify;
        }
    </style>
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
                                <p class="tour-details__top-rate">
                                    @if (empty($tour->makhuyenmai))
                                        <span>{{ number_format($tour->giatour) }}đ</span>
                                    @else
                                        <span><del class="original-price">{{ number_format($tour->giatour) }}đ</del>
                                            {{ number_format($tour->giatourgiam) }}đ</span>
                                    @endif
                                </p>
                            </div>
                            <div class="tour-details__top-right col-lg-7">
                                <ul class="list-unstyled tour-details__top-list">
                                    <li>
                                        <div class="icon">
                                            <span class="icon-clock"></span>
                                        </div>
                                        <div class="text">
                                            <p>Khoảng thời gian</p>
                                            <h6>{{ @$tour->thoigiandi }} ngày</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-plane"></span>
                                        </div>
                                        <div class="text">
                                            <p>Loại tour</p>
                                            <h6>{{ @$tour->tenloai }}</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-place"></span>
                                        </div>
                                        <div class="text">
                                            <p>Địa điểm</p>

                                            @if ($tour->tendiemdulich == null)
                                                <h6>Đang cập nhật</h6>
                                            @else
                                                <h6>{{ $tour->tendiemdulich }}</h6>
                                            @endif
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
                                    <li>
                                        @if ($averageRating == null)
                                        @else
                                            @php
                                                $soSaoNguyen = floor(@$averageRating->avg_rating);
                                                $soSaoDu = $averageRating->avg_rating - $soSaoNguyen;
                                                $soSaoTrong = 5 - $soSaoNguyen - ($soSaoDu >= 0.5 ? 1 : 0);
                                            @endphp
                                            <div class="icon">
                                                @if (!empty($averageRating->avg_rating))
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
                                            <div class="text">
                                                <p>{{ number_format(@$averageRating->avg_rating, 1) }}({{ $averageRating->total_reviews }}
                                                    lượt đánh giá)
                                                </p>
                                            </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>


                            <div class="tour-details__bottom-right">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"><i class="fas fa-share"></i>chia sẻ</a>
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
                <div id="content">
                    <h3 class="mt-4 mb-3" style="color: #444;">{!! $tour->tieude !!}</h3>
                    <p>{!! $tour->mota !!}</p>
                </div>

                @include('frontend.tour.component.tour-note')

                @include('frontend.tour.comment.comment-of-tour')

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
                                            <h3 class="popular-tours__title"><a
                                                    href="{{ route('tour.detail', $item->slug) }}">{{ $item->tentour }}</a>
                                            </h3>

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
                                                    <span><del
                                                            class="original-price">{{ number_format($item->giatour) }}đ</del>
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
            </div>
            <div class="col-lg-4">
                <div class="table-responsive table-detail-info ">
                    <div class="form-group discount form-inline  ">
                        <div class="group-price-row">
                            @if (empty($tour->makhuyenmai))
                                <div class="price-new">{{ number_format($tour->giatour) }}đ</div>
                            @else
                                <div class="price-new"><del
                                        class="original-price">{{ number_format($tour->giatour) }}đ</del>
                                    {{ number_format($tour->giatourgiam) }}đ</div>
                            @endif

                        </div>
                    </div>
                    <table class="table info-product">
                        <tbody>
                            <tr>
                                <td><b><i class="fa-solid fa-calendar-days"></i> Khởi hành:</b></td>
                                @if (empty($ngaybatdau))
                                    <td>Đang cập nhật</td>
                                @else
                                    <td>{{ date('d/m/Y', strtotime($ngaybatdau->ngaybatdau)) }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td><b><i class="fa-regular fa-clock"></i> Thời gian: </b></td>
                                <td>{{ @$tour->thoigiandi }} ngày</td>
                            </tr>
                            <tr>
                                <td><b><i class="fa-solid fa-road"></i> Phương tiện:</b></td>
                                @if (empty($phuongtien))
                                    <td>Đang cập nhật</td>
                                @else
                                    <td>{{ @$phuongtien->tenphuongtien }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td><b><i class="fa-solid fa-hotel"></i> Khách sạn:</b></td>
                                @if (empty($khachsan))
                                    <td>Đang cập nhật</td>
                                @else
                                    <td>{{ @$khachsan->tenkhachsan }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td><b><i class="fa-solid fa-money-bill-1-wave"></i> Giá:</b></td>
                                @if (empty($tour->makhuyenmai))
                                    <td>{{ number_format($tour->giatour) }} VNĐ</td>
                                @else
                                    <td>{{ number_format(@$tour->giatourgiam) }} VNĐ</td>
                                @endif
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
                                    Liên hệ
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a class="btn btn-danger btn-lg btn-booking" href="#"
                                        onclick="submitBookingForm({{ $tour->matour }})">Đặt tour</a>
                                    <button class="btn btn-success btn-lg btn-down-pdf" id="download-pdf">
                                        Tải chi tiết tour
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.home.component.bookNow')

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
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
        <script>
            document.getElementById('download-pdf').addEventListener('click', async function() {
                const {
                    jsPDF
                } = window.jspdf;

                const content = document.getElementById('content');
                const slug = @json($tour->slug);
                try {
                    const canvas = await html2canvas(content, {
                        scale: 2,
                        useCORS: true
                    });

                    const imgData = canvas.toDataURL('image/png');

                    // Thiết lập PDF
                    const pdf = new jsPDF('p', 'mm', 'a4');
                    const imgWidth = 190;
                    const pageHeight = 297;
                    const imgHeight = (canvas.height * imgWidth) / canvas.width;
                    let heightLeft = imgHeight;

                    let position = 20;

                    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;

                    while (heightLeft > 0) {
                        position = heightLeft - imgHeight;
                        pdf.addPage();
                        pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;
                    }

                    pdf.save(slug + '.pdf');
                } catch (error) {
                    console.error('Error generating PDF:', error);
                }
            });
        </script>

        <script>
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
    @endpush
@endsection
