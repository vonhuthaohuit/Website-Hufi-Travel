@extends('frontend.layouts.history')

@section('content-history')
    @if (session('user'))
        @if (count($tours) === 0)
            <div class="transaction-status mt-3">
                <img src="https://ik.imagekit.io/tvlk/image/imageResource/2020/07/10/1594367281441-5ec1b573d106b7aec243b19efa02ac56.svg?tr=h-96,q-75,w-96"
                    alt="No transaction icon">
                <div>
                    <h5>Không có giao dịch đang tiến hành</h5>
                    <p>Bạn không có giao dịch đang tiến hành nào từ phiên giao dịch trước. Những giao dịch chưa
                        hoàn
                        thành sẽ được lưu tại đây.</p>
                </div>
            </div>
        @else
            @foreach ($tours as $item)
                <a class="transaction-item mt-3"
                    href="{{ route('tour.tourOrder', ['matour' => $item->phieuDatTour->tour->matour, 'maphieudattour' => $item->maphieudattour]) }}">
                    <img src="{{ asset($item->phieuDatTour->tour->hinhdaidien ?? 'default.jpg') }}" alt="No transaction icon">
                    <div>
                        <h5>{{ $item->phieuDatTour->tour->tentour ?? 'Không có tên tour' }}</h5>
                        @if (empty($item->phieudattour->tour->makhuyenmai))
                            <p>Giá: {{ number_format($item->phieuDatTour->tour->giatour ?? 0) }}đ -
                                @if (in_array($item->phieudattour->trangthaidattour, ['Yêu cầu hủy tour', 'Đã hủy']))
                                    <span style="color: red;">{{ $item->phieudattour->trangthaidattour }}</span>
                                @else
                                    <span style="color: green;">{{ $item->phieudattour->trangthaidattour }}</span>
                                @endif
                            </p>
                        @else
                            <p>Giá: {{ number_format($item->phieuDatTour->tour->giatourgiam ?? 0) }}đ -
                                @if (in_array($item->phieudattour->trangthaidattour, ['Yêu cầu hủy tour', 'Đã hủy']))
                                    <span style="color: red;">{{ $item->phieudattour->trangthaidattour }}</span>
                                @else
                                    <span style="color: green;">{{ $item->phieudattour->trangthaidattour }}</span>
                                @endif
                            </p>
                        @endif
                    </div>
                </a>
            @endforeach
        @endif
    @else
        <div class="alert alert-primary alert-dismissible fade show" role="alert"
            style="background-color: rgba(27, 160, 226, 1.00); color: #fff;">
            <div class="d-flex align-items-center">
                <img src="https://ik.imagekit.io/tvlk/image/imageResource/2020/07/10/1594367483828-7789b3750733eaf090bd845b4af90e97.svg?tr=h-62,q-75,w-88"
                    alt="Info icon" class="me-3">
                <div>
                    <strong>Dễ dàng truy cập đặt chỗ của bạn trên HUFI Travel</strong><br>
                    <a href="{{ route('login_view') }}" class="alert-link">Đăng nhập</a> vào tài khoản HUFI
                    Travel để xem các đặt chỗ
                    hiện tại và trước đây của bạn, cũng như quản lý mọi vấn đề liên quan tới đặt chỗ (ví dụ: yêu
                    cầu hoàn tiền hoặc đổi lịch).
                </div>
            </div>
            <button class="close-alert" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="transaction-status mt-3">
            <img src="https://ik.imagekit.io/tvlk/image/imageResource/2020/07/10/1594367281441-5ec1b573d106b7aec243b19efa02ac56.svg?tr=h-96,q-75,w-96"
                alt="No transaction icon">
            <div>
                <h5>Không có giao dịch đang tiến hành</h5>
                <p>Bạn không có giao dịch đang tiến hành nào từ phiên giao dịch trước. Những giao dịch chưa hoàn
                    thành sẽ được lưu tại đây.</p>
            </div>
        </div>
    @endif
@endsection
