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

        .close {
            position: absolute;
            right: 10px;
            top: 10px;
            border: none;
            background: transparent;
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
                        @if (empty($ngaybatdau))
                            <p><strong>Ngày bắt đầu:</strong> <span id="startDate">Đang cập nhật</span></p>
                        @else
                            <p><strong>Ngày bắt đầu:</strong> <span id="startDate">
                                    {{ date('d-m-Y', strtotime(@$tour->phieuDatTour->ngaybatdau)) }}</span></p>
                        @endif
                        @if (empty($ngayketthuc))
                            <p><strong>Ngày kết thúc:</strong> <span id="endDate">Đang cập nhật</span></p>
                        @else
                            <p><strong>Ngày kết thúc:</strong> <span
                                    id="endDate">{{ date('d-m-Y', strtotime($ngayketthuc)) }}</span></p>
                        @endif
                        <p><strong>Số lượng thành viên đi tour:</strong> <span
                                id="numPeople">{{ @$tour->phieuDatTour->tongsoluong }}</span>
                            người</span></p>
                        @if (empty(@$tour->phieudattour->tour->makhuyenmai))
                            <p><strong>Giá:</strong> <span
                                    id="price">{{ number_format(@$tour->phieuDatTour->tongtienphieudattour) }}đ</span></p>
                        @else
                            <p><strong>Giá:</strong> <span
                                    id="discountPrice">{{ number_format(@$tour->phieuDatTour->tour->giatourgiam) }}đ</span>
                            </p>
                        @endif
                        <p><strong>Tình trạng:</strong> <span
                                style="color: green;">{{ @$tour->phieuDatTour->trangthaidattour }}</span></p>
                        @if (@$tour->phieuDatTour->trangthaidattour == 'Đã thanh toán')
                            <div class="d-flex justify-content-end">
                                <button class="me-3 btn btn-danger btn-cancel-tour">Hủy tour</button>
                                <button class="btn btn-create-comment" href="">Đánh giá</button>
                            </div>
                        @elseif (@$tour->phieuDatTour->trangthaidattour == 'Đã hủy')
                            <p><strong>Lý do hủy:</strong> {{ @$phieuhuy->lydohuy }}</p>
                            <p><strong>Ngày hủy:</strong> {{ date('d-m-Y', strtotime(@$phieuhuy->ngayhuy)) }}</p>
                            <p><strong>Số tiền hoàn:</strong> {{ number_format(@$phieuhuy->sotienhoan) }}đ</p>
                        @else
                            <div class="d-flex justify-content-end">
                                <button type="button" id="tieptucthanhtoan" class="btn btn-success">Tiếp tục thanh
                                    toán</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        @if ($tour->phieuDatTour->trangthaidattour == 'Đã thanh toán' || $tour->phieuDatTour->trangthaidattour == 'Đã hủy')
                            <h5 class="mb-3" style="color: #08c; font-weight: 700;">Thông tin người đặt</h5>
                        @else
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-3" style="color: #08c; font-weight: 700;">Thông tin người đặt</h5>
                                <a class="" href="{{ route('profile') }}" style="color: #08c; cursor: pointer;"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            </div>
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
                        @if (@$tour->phieuDatTour->trangthaidattour == 'Đã thanh toán' || @$tour->phieuDatTour->trangthaidattour == 'Đã hủy')
                            <h5 class="mb-3" style="color: #08c; font-weight: 700;">Danh sách thành viên đi tour</h5>
                        @else
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-3" style="color: #08c; font-weight: 700;">Danh sách thành viên đi tour</h5>
                                <a class="" href="" style="color: #08c; cursor: pointer;">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>
                        @endif
                        @foreach (@$soLuongKhach as $item)
                            <p><strong style="color: #08c;">Khách hàng {{ $loop->iteration }}.</strong></p>
                            <p><strong>Họ tên:</strong> {{ @$item->hoten }}</p>
                            <p><strong>Giới tính:</strong> {{ @$item->gioitinh }}</p>
                            <p><strong>Ngày sinh:</strong> {{ date('d/m/Y', strtotime(@$item->ngaysinh)) }}</p>
                            <p><strong>Loại khách hàng:</strong> {{ @$item->tenloaikhachhang }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Chọn phương thức thanh toán</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><strong>Phương thức thanh toán:</strong></label>
                        <select id="paymentMethod" class="form-control">
                            <option value="direct">Thanh toán trực tiếp</option>
                            <option value="online">Thanh toán online</option>
                        </select>
                    </div>
                    <div id="onlineOptions" class="form-group" style="display:none;">
                        <button id="pay-vnpay" class="btn btn-vnpay" data-method="vnpay"><img src="{{ asset('frontend/images/vnpay.png') }}" alt="Thanh toán VNPay" width="100" height="40"></button>
                        <button id="pay-momo" class="btn btn-momo" data-method="momo"><img src="{{ asset('frontend/images/momo.png') }}" alt="Thanh toán momo" width="100" height="85"></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirmPayment">Xác nhận</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#tieptucthanhtoan').on('click', function() {
                    $('#paymentModal').modal('show');
                });

                $('#paymentMethod').on('change', function() {
                    if ($(this).val() === 'online') {
                        $('#onlineOptions').show();
                    } else {
                        $('#onlineOptions').hide();
                    }
                });

                $('#confirmPayment').on('click', function() {
                    const paymentMethod = $('#paymentMethod').val();
                    if (paymentMethod === 'direct') {
                        $('<form>', {
                            'method': 'POST',
                            'action': '{{ route('tour.step4') }}',
                            'html': '@csrf' +
                                '<input type="hidden" name="phieuDatTourid" value="{{ $tour->phieuDatTour->maphieudattour }}">'
                        }).appendTo('body').submit();
                    }
                });


                $('#pay-vnpay, #pay-momo').on('click', function() {
                    const method = $(this).data('method');
                    const formAction = (method === 'vnpay') ? '{{ route('vnpay.payment') }}' :
                        '{{ route('momo.payment') }}';

                    const data = {
                        '_token': '{{ csrf_token() }}',
                        'phieudattourid': '{{ $tour->phieuDatTour->maphieudattour }}'
                    };

                    $.ajax({
                        url: formAction,
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            if (response.status === 'success' && response.redirect) {
                                window.location.href = response
                                    .redirect;
                            } else {
                                alert('Có lỗi xảy ra khi thanh toán.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Đã xảy ra lỗi trong quá trình thanh toán.');
                        }
                    });
                });

            });
        </script>
    @endpush

    @include('frontend.tour.comment.createComment')
    @include('frontend.tour.component.cancel-tour')
@endsection
