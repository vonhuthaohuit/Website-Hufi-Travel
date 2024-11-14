@extends('frontend.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/transactions.css') }}">
@endpush

@section('renderBody')
    <div class="container mt-5 py-5" style="min-height: 500px;">
        <div class="row">
            <div class="col-md-4 sidebar">
                <h3 class="mb-3">Giao dịch đang tiến hành</h3>
                <button class="btn btn-primary d-flex justify-start">
                    <svg class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" data-id="IcUserBooking">
                        <path
                            d="M4 7V19C4 20.1046 4.89543 21 6 21H18C19.1046 21 20 20.1046 20 19V7M4 7V5C4 3.89543 4.89543 3 6 3H18C19.1046 3 20 3.89543 20 5V7M4 7H8.5M20 7H12"
                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            d="M16 17H12.5C12.2239 17 12 16.7761 12 16.5C12 16.2239 12.2239 16 12.5 16H16C16.2761 16 16.5 16.2239 16.5 16.5C16.5 16.7761 16.2761 17 16 17Z"
                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            d="M16 12H12.5C12.2239 12 12 11.7761 12 11.5C12 11.2239 12.2239 11 12.5 11H16C16.2761 11 16.5 11.2239 16.5 11.5C16.5 11.7761 16.2761 12 16 12Z"
                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M7.5 12V11H8.5V12H7.5Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M7.5 17V16H8.5V17H7.5Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg> Tất cả sản phẩm
                </button>

            </div>

            <div class="col-md-8">
                <div class="alert alert-primary alert-dismissible fade show" role="alert"
                    style="background-color: rgba(27, 160, 226, 1.00); color: #fff;">
                    <div class="d-flex align-items-center">
                        <img src="https://ik.imagekit.io/tvlk/image/imageResource/2020/07/10/1594367483828-7789b3750733eaf090bd845b4af90e97.svg?tr=h-62,q-75,w-88"
                            alt="Info icon" class="me-3">
                        <div>
                            <strong>Dễ dàng truy cập đặt chỗ của bạn trên HUFI Travel</strong><br>
                            <a href="{{ route('login_view') }}" class="alert-link">Đăng nhập</a> vào tài khoản HUFI Travel để xem các đặt chỗ
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
            </div>
        </div>
    </div>
@endsection
