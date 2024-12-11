@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ asset('frontend/css/style_dattour.css') }}">
@section('renderBody')
    <div class="content container pt-5">
        <div class="container-fluid">
            <div class="panel panel-1">
                <div class="panel-body">
                    <form name="tourBooking" method="post" class="form-horizontal frm-tour-booking" role="form"
                        action="">
                        <ul class="nav nav-tabs nav-justified frm-tour-booking-step" role="tablist">
                            <li role="presentation" class="active"><b>Chọn tour</b><i class="fa fa-check"></i></li>
                            <li role="presentation" class="active"><b>Đăng ký tour</b><i class="fa fa-check"></i></li>
                            <li role="presentation" class="active"><b>Xác nhận thông tin</b><i class="fa fa-check"></i></li>
                            <li role="presentation" class="active"><b>Hoàn thành</b><i class="fa fa-check"></i></li>
                        </ul>

                        <div class="content_book tour-des">
                            <header class="content-header">
                                <h3 class="py-3">Đặt tour thất bại!</h3>
                            </header>
                            <div style="font-size: 40px; text-align:center; margin-top:30px">
                                <img src="{{ asset('frontend/images/error.png') }}" alt="" width="100"
                                    height="100">
                            </div>
                            <div style="max-width: 900px; text-align:center; margin:auto; margin-top:30px">
                                <p>Cám ơn quý khách đã đăng ký tour tại <b>HUFI Travel</b>.
                                    <br>
                                    Click <a class="text-info" href="/">vào đây</a> trở về trang chủ.
                                </p>
                                <p>Một email xác nhận đã được gửi đến địa chỉ <a
                                        href="mailto:info@hufitravel.com.vn /sales@hufitravel.com.vn">info@hufitravel.com.vn
                                        /sales@hufitravel.com.vn</a>.</p>
                            </div>
                            <div class="bs-callout bs-callout-danger">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            setTimeout(function() {
                console.log('Redirecting...');
                window.location.href = '/';
            }, 5000);
        </script>
    @endpush
@endsection
