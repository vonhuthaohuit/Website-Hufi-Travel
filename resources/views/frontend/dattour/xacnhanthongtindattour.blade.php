@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ asset('frontend/css/style_dattour.css') }}">
@section('renderBody')
    <div class="content container mt-5">
        <div class="container-fluid">
            <div class="panel panel-1">
                <div class="panel-body">
                    <form name="tourBooking" method="post" class="form-horizontal frm-tour-booking" role="form"
                        id="form-booking-step2">
                        <input type="hidden" name="ticket_id" value="4457">
                        <input type="hidden" name="payment_id" value="1">

                        <!-- Nav tabs -->
                        <ul class="nav nav-justified frm-tour-booking-step" role="tablist">
                            <li role="presentation" class="active"><b>Chọn tour</b><i class="fa fa-check"></i></li>
                            <li role="presentation" class="active"><b>Đăng ký tour</b><i class="fa fa-check"></i></li>
                            <li role="presentation" class="active"><b>Xác nhận thông tin</b><i class="fa fa-check"></i></li>
                            <li role="presentation"><b>Hoàn thành</b><i class="fa fa-times"></i></li>
                        </ul>
                        <div class="content_book tour-des mt-3">
                            <header class="content-header">
                                <h3>Thông tin tour</h3>
                            </header>
                            <div class="content-body">
                                <p>
                                    <b>
                                        <i class="glyphicon glyphicon-pushpin"></i>
                                        Tour Du Lịch Nha Trang - Đà Lạt 5 Ngày 4 Đêm: Cung Đường Nối Biển Và Hoa </b>
                                </p>
                                <p>
                                    <b>Mã tour:</b>
                                    DL5N4D
                                </p>
                                <p>
                                    <b>Thời gian:</b>
                                    5 ngày
                                </p>
                                <p>
                                    <b>Ngày khởi hành:</b>
                                    Đang cập nhật
                                </p>
                                <p>
                                    <b>Nơi khởi hành:</b>
                                    TP.HCM
                                </p>
                            </div>
                        </div>
                        <div class="content_book customers-info">
                            <header class="content-header">
                                <h3>Thông tin liên lạc</h3>
                            </header>
                            <div class="content-body">
                                <p>
                                    <b>Họ tên:</b>
                                    aa
                                </p>
                                <p>
                                    <b>Địa chỉ:</b>
                                    aaa
                                </p>
                                <p>
                                    <b>Điện thoại:</b>
                                    12312312
                                </p>
                                <p>
                                    <b>Email:</b>
                                    12312@gmail.com
                                </p>
                                <p>
                                    <b>Ghi chú:</b>
                                    123123123
                                </p>
                                <p>
                                    <b>Tổng số khách:</b> 1
                                </p>
                                <div class="content_book">
                                    <header class="content-header">
                                        <h3>Danh sách khách hàng đi tour</h3>
                                    </header>
                                    <div class="content-body">
                                        <table class="table table-striped table-hover customers-list">

                                            <thead>
                                                <tr>
                                                    <th class="title text-justify" colspan="7"><i
                                                            class="fa fa-list-alt"></i> Danh sách khách đi
                                                        tour</th>
                                                </tr>
                                                <tr>
                                                    <th width="20">STT</th>
                                                    <th>Họ tên</th>
                                                    <th>Khách hàng</th>
                                                    <th>Độ tuổi</th>
                                                    <th>Phòng đơn</th>
                                                    <th>Giá</th>
                                                </tr>
                                            </thead>
                                            <tbody class="add_plus_tbd">
                                                <tr>
                                                    <td>
                                                        1 </td>
                                                    <td>
                                                        aaa </td>
                                                    <td>
                                                        Người lớn </td>
                                                    <td>
                                                        111111 </td>
                                                    <td>
                                                        Không </td>
                                                    <td>
                                                        2,290,000 </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"></td>
                                                    <td><strong>Tổng tiền :</strong></td>
                                                    <td>
                                                        <input type="hidden" name="amount" value="{{ 200000 }}">
                                                        {{ 20000 }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content_book payment">
                            <header class="content-header">
                                <h3>Phương thức thanh toán</h3>
                            </header>
                            <div class="content-body" style="font-weight: bold; text-transform: uppercase">

                                <div class="payment-method">
                                    <?php if ($phuongThucThanhToan == 1): ?>
                                    <h4 class="payment-title">Phương thức thanh toán:</h4>
                                    <p class="payment-type">Thanh toán trực tiếp</p>

                                    <div class="company-info">
                                        <h5><strong>CÔNG TY CỔ PHẦN VIETOURIST HOLDINGS</strong></h5>
                                        <p>
                                            <strong>Địa chỉ:</strong> 95B-97-99 Trần Hưng Đạo, Phường Cầu Ông Lãnh, Quận 1,
                                            Tp. Hồ Chí Minh<br>
                                            <strong>Điện thoại:</strong> 028. 62 61 63 65<br>
                                            <strong>Hotline:</strong> 089 990 9145
                                        </p>
                                    </div>
                                    <?php else: ?>
                                    <p class="payment-type">Thanh toán online</p>

                                    <div class="payment-buttons">
                                        <a href="#" id="pay-btn" class="btn btn-success"
                                            data-amount="{{ 200000 }}">Thanh toán VNPay</a>
                                        <a href="{{ route('momo.payment') }}" class="btn btn-success">Thanh toán Momo</a>
                                    </div>

                                    <?php endif; ?>
                                    {{-- Modal thanh toán --}}
                                    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog"
                                        aria-labelledby="paymentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="paymentModalLabel">Thông tin thanh toán
                                                        VNPay</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="qr-code-container"></div>
                                                    <p id="payment-info"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <a class="btn btn-warning" href="javascript:javascript:history.go(-1)"><span
                                        class="fa fa-chevron-left"></span> Quay về</a>
                                <button type="submit" name="tour_tep2" id="tour_step2" class="btn btn-success">
                                    Tiếp tục <span class="fa fa-chevron-right"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-qrcode/1.0/jquery.qrcode.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pay-btn').click(function(e) {
                e.preventDefault();

                var tongtien = $(this).data('amount');

                $.ajax({
                    url: '{{ route('vnpay.payment') }}',
                    type: 'POST',
                    data: {
                        amount: tongtien,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            window.location.href = response.redirect;
                        } else {
                            alert('Không nhận được thông tin thanh toán.');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('Đã xảy ra lỗi trong quá trình thanh toán.');
                    }
                });
            });
        });
    </script>
@endsection
