@extends('frontend.layouts.app')

@push('style')
    <style>
        .card {
            border: none;
        }

        .btn-back {
            background-color: #08c;
            color: #fff;
        }

        .btn-back:hover {
            background-color: #007bff;
            color: #fff;
        }

        .card-detail {
            position: sticky;
            top: 140px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('frontend/css/styleCancelTour.css') }}">
@endpush

@section('renderBody')
    <div class="container-xl py-4">
        <a class="btn mb-3 btn-back shadow" href="{{ url()->previous() }}">
            <i class="fas fa-arrow-left"></i> Quay về
        </a>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow card-detail">
                    <div class="card-body">
                        <h5 class="mb-3" style="color: #08c; font-weight: 700;"><span
                                id="tourName">{{ $tour->phieuDatTour->tour->tentour }}</span></h5>
                        <img src="{{ asset($tour->phieuDatTour->tour->hinhdaidien) }}"
                            alt="{{ $tour->phieuDatTour->tour->hinhdaidien }}" width="100%" class="mb-3">
                        <p><strong>Ngày bắt đầu:</strong> <span id="startDate">2024-12-10</span></p>
                        <p><strong>Ngày kết thúc:</strong> <span id="endDate">2024-12-15</span></p>
                        <p><strong>Số lượng thành viên đi tour:</strong> <span
                                id="numPeople">{{ $tour->phieuDatTour->tongsoluong }}</span>
                            người</span></p>
                        @if (empty($tour->phieudattour->tour->makhuyenmai))
                            <p><strong>Giá:</strong> <span
                                    id="price">{{ number_format($tour->phieuDatTour->tour->giatour) }}đ</span></p>
                        @else
                            <p><strong>Giá:</strong> <span
                                    id="discountPrice">{{ number_format($tour->phieuDatTour->tour->giatourgiam) }}đ</span>
                            </p>
                        @endif
                        <p><strong>Tình trạng:</strong> <span
                                style="color: green;">{{ $tour->phieuDatTour->trangthaidattour }}</span></p>

                        @if ($tour->phieuDatTour->trangthaidattour == 'Đã thanh toán')
                            <div class="d-flex justify-content-end">
                                <button class="me-3 btn btn-danger btn-cancel-tour">Hủy tour</button>
                                <button class="btn btn-create-comment" href="">Đánh giá</button>
                            </div>
                        @else
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-success" href="">Tiếp tục thanh toán</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        @if ($tour->phieuDatTour->trangthaidattour != 'Đã thanh toán')
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-3" style="color: #08c; font-weight: 700;">Thông tin người đặt</h5>
                                <div class="" style="color: #08c; cursor: pointer;"><i
                                        class="fa-solid fa-pen-to-square"></i></div>
                            </div>
                        @else
                            <h5 class="mb-3" style="color: #08c; font-weight: 700;">Thông tin người đặt</h5>
                        @endif
                        <p><strong>Họ và tên:</strong> <span id="startDate">{{ $khachHang->hoten }}</span></p>
                        <p><strong>Ngày đặt:</strong> <span
                                id="endDate">{{ date('d/m/Y', strtotime($tour->phieuDatTour->ngaydattour)) }}</span></p>
                        <p><strong>Số điện thoại:</strong> <span id="numPeople">{{ $khachHang->sodienthoai }}</span></p>
                        <p><strong>Giới tính:</strong> <span id="sex">{{ $khachHang->gioitinh }}</span></p>
                        <p><strong>Ngày sinh:</strong> <span
                                id="bod">{{ date('d/m/Y', strtotime($khachHang->ngaysinh)) }}</span></p>
                        <p><strong>Email:</strong> {{ $user['email'] }}</p>
                        <p><strong>Địa chỉ:</strong> <span id="address">{{ $khachHang->diachi }}</span></p>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        @if ($tour->phieuDatTour->trangthaidattour != 'Đã thanh toán')
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-3" style="color: #08c; font-weight: 700;">Danh sách thành viên đi tour</h5>
                                <div class="" style="color: #08c; cursor: pointer;">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </div>
                            </div>
                        @else
                            <h5 class="mb-3" style="color: #08c; font-weight: 700;">Danh sách thành viên đi tour</h5>
                        @endif
                        @foreach ($soLuongKhach as $item)
                            <p><strong style="color: #08c;">Khách hàng {{ $loop->iteration }}.</strong></p>
                            <p><strong>Họ tên:</strong> {{ $item->hoten }}</p>
                            <p><strong>Giới tính:</strong> {{ $item->gioitinh }}</p>
                            <p><strong>Ngày sinh:</strong> {{ date('d/m/Y', strtotime($item->ngaysinh)) }}</p>
                            <p><strong>Loại khách hàng:</strong> {{ $item->tenloaikhachhang }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.tour.comment.createComment')
    @include('frontend.tour.component.cancel-tour')
@endsection
