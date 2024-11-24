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
                        <h5 class="mb-3" style="color: #08c; font-weight: 700;">{{ $tour->phieuDatTour->tour->tentour }}
                        </h5>
                        <img src="{{ asset($tour->phieuDatTour->tour->hinhdaidien) }}"
                            alt="{{ $tour->phieuDatTour->tour->hinhdaidien }}" width="100%" class="mb-3">
                        <!-- Các phần thông tin tour như cũ -->

                        @if ($tour->phieuDatTour->trangthaidattour == 'Đã thanh toán')
                            <div class="d-flex justify-content-end">
                                <button class="me-3 btn btn-danger btn-cancel-tour">Hủy tour</button>
                                <button class="btn btn-primary">Đánh giá</button>
                            </div>
                        @else
                            <div class="d-flex justify-content-end">
                                <button type="button" id="tieptucthanhtoan" class="btn btn-success">Tiếp tục thanh
                                    toán</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Thông tin khách hàng và thành viên đi tour như cũ -->
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
                        <button id="pay-vnpay" class="btn btn-success" data-method="vnpay">Thanh toán VNPay</button>
                        <button id="pay-momo" class="btn btn-success" data-method="momo">Thanh toán Momo</button>
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
@endsection
