@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ asset('frontend/css/style_dattour.css') }}">

@section('renderBody')
    <div class="content container mt-5">
        <div class="container-fluid">
            <div class="panel panel-1">
                <div class="panel-body">
                    <form action="{{ route('tour.step4') }}" name="tourBooking" method="post" class="form-horizontal frm-tour-booking" role="form"
                        id="form-booking-step2">
                        @csrf

                        <!-- Nav tabs -->
                        <ul class="nav nav-justified frm-tour-booking-step" role="tablist">
                            <li role="presentation" class="active"><b>Chọn tour</b><i class="fa fa-check"></i></li>
                            <li role="presentation" class="active"><b>Đăng ký tour</b><i class="fa fa-check"></i></li>
                            <li role="presentation" class="active"><b>Xác nhận thông tin</b><i class="fa fa-check"></i></li>
                            <li role="presentation"><b>Hoàn thành</b><i class="fa fa-times"></i></li>
                        </ul>

                        <!-- Thông tin Tour -->
                        <div class="content_book tour-des mt-3">
                            <header class="content-header">
                                <h3>Thông tin tour</h3>
                            </header>
                            <div class="content-body">
                                <p>
                                    <b>
                                        <i class="glyphicon glyphicon-pushpin"></i>
                                        {{ $tour->tentour }} </b>
                                </p>
                                <p>
                                    <b>Thời gian:</b>
                                    {{ $tour->thoigiandi }}
                                </p>
                                <p>
                                    <b>Nơi khởi hành:</b>
                                    {{ $tour->noikhoihanh }}
                                </p>
                            </div>
                        </div>

                        <!-- Thông tin khách hàng -->
                        <div class="content_book customers-info">
                            <header class="content-header">
                                <h3>Thông tin liên lạc</h3>
                            </header>
                            <div class="content-body">
                                <p>
                                    <b>Họ tên:</b> {{ $data['ticket_fullname'] }}
                                </p>
                                <p>
                                    <b>Địa chỉ:</b> {{ $data['ticket_address'] }}
                                </p>
                                <p>
                                    <b>Điện thoại:</b> {{ $data['ticket_phone'] }}
                                </p>
                                <p>
                                    <b>Email:</b> {{ $data['ticket_email'] }}
                                </p>
                                <p>
                                    <b>Ghi chú:</b> {{ $data['ticket_note'] }}
                                </p>
                                <p>
                                    <b>Tổng số khách:</b> {{ $data['ticket_total_customer'] }}
                                </p>

                                <!-- Danh sách khách hàng đi tour -->
                                <div class="content_book">
                                    <header class="content-header">
                                        <h3>Danh sách khách hàng đi tour</h3>
                                    </header>
                                    <div class="content-body">
                                        <table class="table table-striped table-hover customers-list">
                                            <thead>
                                                <tr>
                                                    <th class="title text-justify" colspan="7"><i
                                                            class="fa fa-list-alt"></i> Danh sách khách đi tour</th>
                                                </tr>
                                                <tr>
                                                    <th width="20">STT</th>
                                                    <th>Họ tên</th>
                                                    <th>Khách hàng</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Giới tính</th>
                                                    <th>Giá</th>
                                                </tr>
                                            </thead>
                                            <tbody class="add_plus_tbd">
                                                @php
                                                    $totalAmount = 0; // Khởi tạo tổng tiền
                                                @endphp

                                                @foreach ($data['td_ticket'] as $index => $ticket)
                                                    @if (!empty($ticket['td_name']))
                                                        <!-- Kiểm tra nếu td_name có giá trị -->
                                                        <tr>
                                                            <td>{{ $index }}</td>
                                                            <td>{{ $ticket['td_name'] }}</td>
                                                            <td>{{ $ticket['td_loaikhach'] == '1' ? 'Người lớn' : 'Trẻ em' }}
                                                            </td>
                                                            <td>{{ $ticket['td_birthday'] }}</td>
                                                            <td>{{ $ticket['td_gender'] }}</td>
                                                            <td>{{ number_format($ticket['td_price']) }}</td>
                                                        </tr>
                                                        @php
                                                            $totalAmount += $ticket['td_price'];
                                                        @endphp
                                                    @endif
                                                @endforeach

                                                <tr>
                                                    <td colspan="4"></td>
                                                    <td><strong>Tổng tiền :</strong></td>
                                                    <td>
                                                        <input type="hidden" name="phieuDatTourid"
                                                            value="{{ $phieuDatTour['maphieudattour'] }}">
                                                        <input type="hidden" name="amount" value="{{ $totalAmount }}">
                                                        <span>{{ number_format($totalAmount) }}</span>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <div class="content_book payment">
                            <header class="content-header">
                                <h3>Phương thức thanh toán</h3>
                            </header>
                            <div class="content-body" style="font-weight: bold; text-transform: uppercase">
                                <div class="payment-method">
                                    @if ($data['payment_id'] == 1)
                                        <h4 class="payment-title">Phương thức thanh toán:</h4>
                                        <p class="payment-type">Thanh toán trực tiếp</p>
                                    @else
                                        <p class="payment-type">Thanh toán online</p>
                                        <div class="payment-buttons">
                                            <a href="#" id="pay-btn" class="btn btn-success"
                                                data-amount="{{ number_format($totalAmount) }}"
                                                data-phieudattourid = "{{ $phieuDatTour['maphieudattour'] }}">Thanh toán VNPay</a>
                                            <a id="pay-btn-momo" href="#" class="btn btn-success"
                                                data-amount="{{ number_format($totalAmount) }}"
                                                data-phieudattourid = "{{ $phieuDatTour['maphieudattour'] }}">Thanh toán
                                                Momo</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Modal thanh toán --}}
                        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog"
                            aria-labelledby="paymentModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModalLabel">Thông tin thanh toán
                                            VNPay</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                        <div class="form-group">
                            <div class="text-center">
                                <a class="btn btn-warning" href="javascript:history.go(-1)"><span
                                        class="fa fa-chevron-left"></span>
                                    Quay
                                    về</a>
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
                var phieudattourid = $(this).data('phieudattourid');

                $.ajax({
                    url: '{{ route('vnpay.payment') }}',
                    type: 'POST',
                    data: {
                        amount: tongtien,
                        phieudattourid: phieudattourid,
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
            $('#pay-btn-momo').click(function(e) {
                e.preventDefault();

                var tongtien = $(this).data('amount');
                var phieudattourid = $(this).data('phieudattourid');
                $.ajax({
                    url: '{{ route('momo.payment') }}',
                    type: 'POST',
                    data: {
                        amount: tongtien,
                        phieudattourid: phieudattourid,
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
