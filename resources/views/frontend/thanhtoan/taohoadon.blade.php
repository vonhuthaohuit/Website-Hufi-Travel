@extends('backend.layouts.master')
<link rel="stylesheet" href="{{ asset('frontend/css/style_dattour.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection__clear {
        margin-top: 50px;
    }

    .panel-1 {
        padding: 15px;
    }

    #customerTable th,
    #customerTable td {
        text-align: left;
        vertical-align: middle;
    }

    #customerTable td input,
    #customerTable td select {
        width: 100%;
        box-sizing: border-box;
    }

    #customerTable td.action-cell {
        width: 120px;
    }

    #customerTable td.price-cell {
        width: 0px;
    }

    #customerTable td.gender {
        width: 0px;
    }

    #customerTable td input[type="date"] {
        max-width: 140px;
    }
</style>
@section('content')
    @php
        $trangThaiThanhToan = ['Đang chờ xác nhận đặt tour', 'Chưa thanh toán', 'Đã thanh toán'];
    @endphp
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm hóa đơn mới</h2>
                <form action="{{ route('hoadon.store') }}" name="tourBooking" method="POST"
                    class="form-horizontal frm-tour-booking" id="form-booking" novalidate="novalidate">
                    @csrf
                    <div class="panel panel-1">
                        <div class="content_book tour-des">
                            <label class="col-md-2 control-label">Chọn tour</label>
                            <div class="col-md-10">
                                <select name="tour_id" id="tourSelect" class="form-control" required>
                                    <option value="">Chọn tour</option>
                                    @foreach ($tours as $tour)
                                        <option value="{{ $tour->matour }}">{{ $tour->tentour }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="content_book select-khach-hang mt-3">
                            <label class="col-md-2 control-label">Chọn tài khoản</label>
                            <div class="col-md-10">
                                <select name="user_id" id="taiKhoanSelect" class="form-control">
                                    <option value="">Chọn tài khoản</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="content_book choose-ngay-khoi-hanh mb-4">
                            <header class="content-header">
                                <h3>Chọn ngày khởi hành</h3>
                            </header>
                            <div class="content-body">
                                <div class="mb-3 row">
                                    <label for="ticket_ngaykhoihanh" class="col-md-2">Ngày khởi hành <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <select name="ticket_ngaykhoihanh" id="ticket_ngaykhoihanh"
                                                class="form-control js-ngaykhoihanh" required>
                                                <option value="" disabled selected>Chọn ngày khởi hành</option>
                                            </select>
                                        </div>

                                        <span class="text-danger error-message" style="display: none;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-body" id="tourDetails">
                            <p><b id="tourName"></b></p>
                            <p id="tourTime"></p>
                            <p id="tourStartDate"></p>
                            <p id="tourDepartureLocation"></p>
                            <p id="tourPrice"></p>
                        </div>

                        <div class="content_book tour-price-advance">
                            <header class="content-header">
                                <h3>Giá tour</h3>
                            </header>
                            <div class="content-body">
                                <table id="customerPriceTable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Loại khách</th>
                                            <th>Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        <div class="content_book customers-info">
                            <header class="content-header">
                                <h3>Thông tin liên lạc</h3>
                            </header>
                            <div class="content-body">
                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Họ &amp; Tên (Người đại diện) <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="ticket_fullname" value=""
                                            required="">
                                    </div>
                                </div>
                                <div class="form-group row mt-3 mb-3">
                                    <label class="col-sm-2 control-label">Căn cước công dân <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ticket_cccd"
                                            value="{{ @$khachHang->cccd }}" required=""
                                            data-msg="Trường này là bắt buộc!">
                                        <span class="text-danger error-message" style="display: none;"></span>
                                    </div>
                                </div>
                                <div class="form-group row mt-3 mb-3">
                                    <label class="col-sm-2 control-label">Địa chỉ (Cá nhân/đơn vị) <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ticket_address" value=""
                                            required="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Điện thoại <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="ticket_phone"
                                                    value="" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" name="ticket_email"
                                                    value="" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ghi chú</label>
                                    <div class="col-sm-12">
                                        <textarea name="ticket_note" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Phương thức thanh toán</label>
                                    <div class="col-sm-10">
                                        <select name="phuongthucthanhtoan" class="form-control">
                                            <option value="Chuyển khoản">Chuyển khoản</option>
                                            <option value="Tiền mặt">Tiền mặt</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label class="col-sm-2 control-label">Trạng thái thanh toán</label>
                                    <div class="col-sm-10">
                                        <select name="trangthaithanhtoan" class="form-control">
                                            @foreach ($trangThaiThanhToan as $item)
                                                <option value="{{ $loop->index }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="content_book">
                                    <header class="content-header">
                                        <h3>Danh sách khách hàng đi tour</h3>
                                    </header>
                                    <div class="content-body table-responsive-dat-tour">
                                        <table class="table table-striped" id="customerTable">
                                            <thead>
                                                <tr>
                                                    <th>Họ tên <span class="text-danger">*</span></th>
                                                    <th>CCCD <span class="text-danger">*</span></th>
                                                    <th>Số điện thoại <span class="text-danger">*</span></th>
                                                    <th>Ngày sinh <span class="text-danger">*</span></th>
                                                    <th style="width:140px">Giới tính</th>
                                                    <th style="width: 230px">Khách hàng</th>
                                                    <th>Giá</th>
                                                    <th style="text-align: right">Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody class="add_plus_tbd">
                                                <tr class="add_plus_tr" id="customerRowTemplate">
                                                    <td>
                                                        <input type="hidden" class="form-control" name="stt"
                                                            value="1">
                                                        <input type="text" class="form-control name-khach-hang-di-tour"
                                                            id="td_name_1" name="td_ticket[1][td_name]" placeholder="Tên"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control cccd" id="td_cccd_1"
                                                            name="td_ticket[1][td_cccd]" placeholder="CCCD" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control sdt" id="td_sdt_1"
                                                            name="td_ticket[1][td_sdt]" placeholder="Số điện thoại"
                                                            required>
                                                    </td>
                                                    <td><input type="date"
                                                            class="form-control ngay-sinh-khach-hang-di-tour"
                                                            id="td_birthday_1" name="td_ticket[1][td_birthday]"
                                                            min="1900-01-01" max="2025-01-01" placeholder="01/01/1990"
                                                            required onchange="calculateAgeAndUpdateCustomerType(this)">
                                                    </td>
                                                    <td class="gender">
                                                        <select name="td_ticket[1][td_gender]" id="td_gender_1"
                                                            class="form-control">
                                                            <option value="Nam">Nam</option>
                                                            <option value="Nữ">Nữ</option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <select name="td_ticket[1][td_loaikhach]" id="td_loaikhach_1"
                                                            class="form-control js-type-customer"
                                                            onchange="selectTypeCustomer(this)">
                                                            <option value="">Chọn loại khách</option>
                                                        </select>
                                                    </td>
                                                    <td class="price-cell">
                                                        <input type="hidden" class="form-control js-input-price"
                                                            id="td_price_1" name="td_ticket[1][td_price]" value="">
                                                        <span class="td-price">VNĐ</span>
                                                    </td>
                                                    <td class="action-cell" style="text-align: right;">
                                                        <a class="text-danger" href="javascript:;"
                                                            onclick="removeCustomer(this)" title="Xóa">
                                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div style="text-align: right">
                                        <input hidden type="file" id="csvFileInput" accept=".xlsx" />
                                        <button hidden class="btn btn-primary" id="btn-import-csv">Import Excel</button>
                                        <button type="button" id="btn-add-more-customer" class="btn btn-info">
                                            <i class="fa fa-plus"></i> Thêm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button id="tao-hoa-don" type="submit" class="btn btn-success btn-lg">Tạo hóa
                                đơn</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('frontend/js/script_dattour_admin.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#tourSelect').change(function() {
                    var tourId = $(this).val();
                    if (tourId) {
                        $.ajax({
                            url: '/get-tour-details/' + tourId,
                            type: 'GET',
                            success: function(data) {
                                $('#tourName').text(data.tentour);
                                $('#tourTime').text('Thời gian: ' + data.thoigiandi);
                                $('#tourStartDate').text('Ngày khởi hành: ' + (data.ngaybatdau ?
                                    moment(data.ngaybatdau).format('DD-MM-YYYY') :
                                    'Đang cập nhật'));
                                $('#tourDepartureLocation').text('Nơi khởi hành: ' + data
                                    .noikhoihanh);
                                $('#tourPrice').text('Giá tour: ' + data.giatour);

                                var tableBody = '';

                                if (data.giatourloaikhachhang && data.loaikhachhang) {
                                    let tableBody = '';
                                    data.giatourloaikhachhang.forEach(function(price, index) {
                                        tableBody += '<tr>';
                                        tableBody += '<td>' + data.loaikhachhang[index]
                                            .tenloaikhachhang + '</td>';
                                        tableBody += '<td class="price-cell">';
                                        tableBody += '<span class="td-price">' +
                                            number_format(price) + ' VNĐ</span>';
                                        tableBody += '</td>';
                                        tableBody += '</tr>';
                                    });
                                    $('#customerPriceTable tbody').html(tableBody);
                                } else {
                                    $('#customerPriceTable tbody').html(
                                        '<tr><td colspan="2">Không có dữ liệu</td></tr>');
                                }


                                $('.js-type-customer').each(function() {
                                    $(this).html(
                                        '<option value="">Chọn loại khách</option>'
                                    );
                                });

                                if (data.loaikhachhang && data.giatourloaikhachhang) {
                                    data.loaikhachhang.forEach(function(item, index) {
                                        $('.js-type-customer').each(function() {
                                            $(this).append(`
                                <option value="${item.maloaikhachhang}" data-price="${data.giatourloaikhachhang[index]}">
                                    ${item.tenloaikhachhang}
                                </option>
                            `);
                                        });
                                    });
                                }
                            },
                            error: function() {
                                alert('Có lỗi xảy ra khi tải dữ liệu tour.');
                            }
                        });
                        $.ajax({
                            url: '/get-chi-tiet-tour/' + tourId,
                            type: 'GET',
                            success: function(data) {
                                console.log(data);

                                $('.js-ngaykhoihanh').each(function() {
                                    $(this).html(
                                        '<option value="">Chọn ngày khởi hành</option>'
                                    );
                                });

                                const ngayKhoiHanhSelect = $('#ticket_ngaykhoihanh');
                                ngayKhoiHanhSelect.html(
                                    '<option value="" disabled selected>Chọn ngày khởi hành</option>'
                                );

                                if (data && data.length > 0) {
                                    data.forEach(function(ngay) {
                                        ngayKhoiHanhSelect.append(
                                            `<option value="${ngay['ngaybatdau']}">${ngay['ngaybatdau']}</option>`
                                        );
                                    });
                                }
                            },
                            error: function() {
                                alert('Có lỗi xảy ra khi tải dữ liệu tour.');
                            }
                        });
                    } else {
                        $('#tourName').text('');
                        $('#tourTime').text('');
                        $('#tourStartDate').text('');
                        $('#tourDepartureLocation').text('');
                        $('#tourPrice').text('');
                        $('#customerPriceTable tbody').html('');
                        $('.js-type-customer').each(function() {
                            $(this).html('<option value="">Chọn loại khách</option>');
                        });
                        $('js-ngaykhoihanh').html('<option value="">Chọn ngày khởi hành</option>');
                    }
                });

                $(document).on('change', '.js-type-customer', function() {
                    var selectedOption = $(this).find(":selected");
                    var price = selectedOption.data("price");

                    var priceCell = $(this).closest('tr').find('.price-cell');
                    priceCell.html(
                        '<input type="hidden" class="form-control js-input-price" ' +
                        'id="td_price_' + ($(this).closest('tr').index() + 1) + '" ' +
                        'name="td_ticket[' + ($(this).closest('tr').index() + 1) + '][td_price]" ' +
                        'value="' + price + '">' +
                        '<span class="td-price">' + number_format(price) + ' VNĐ</span>'
                    );



                    $(this).closest('td').find('.js-type-customer').show();
                });


            });

            function number_format(number) {
                return number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            }
            $(document).ready(function() {
                $('#taiKhoanSelect').select2({
                    placeholder: "Chọn tài khoản",
                    allowClear: true,
                    minimumInputLength: 0,
                    ajax: {
                        url: '{{ route('get.users') }}',
                        dataType: 'json',
                        delay: 500,
                        data: function(params) {
                            return {
                                q: params.term,
                                page: params.page || 1
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data.items,
                                pagination: {
                                    more: data.pagination.more
                                }
                            };
                        },
                        cache: true
                    }
                });
                $('#taiKhoanSelect').on('select2:open', function() {
                    $('.select2-selection__clear').css({
                        'width': '20px',
                        'height': '20px',
                        'padding': '5px'
                    });
                });

                $('#taiKhoanSelect').on('select2:select', function(e) {
                    var selectedData = e.params.data;
                    $('#taiKhoanSelect').val(selectedData.id).trigger('change');
                });
                $(document).ready(function() {
                    $('#taiKhoanSelect').change(function() {
                        var userId = $(this).val();
                        if (userId) {
                            $.ajax({
                                url: '/get-khachhang-details/' + userId,
                                type: 'GET',
                                success: function(data) {
                                    $('input[name="ticket_fullname"]').val(data.hoten ||
                                        '');
                                    $('input[name="ticket_phone"]').val(data.sodienthoai ||
                                        '');
                                    $('input[name="ticket_address"]').val(data.address ||
                                        '');
                                    $('input[name="ticket_email"]').val(data.email || '');
                                },
                                error: function() {
                                    $('input[name="ticket_fullname"]').val('');
                                    $('input[name="ticket_phone"]').val('');
                                    $('input[name="ticket_address"]').val('');
                                    $('input[name="ticket_email"]').val('');
                                }
                            });
                        } else {
                            $('input[name="ticket_fullname"]').val('');
                            $('input[name="ticket_phone"]').val('');
                            $('input[name="ticket_address"]').val('');
                            $('input[name="ticket_email"]').val('');
                        }
                    });
                });
                $(document).ready(function() {
                    $('#taiKhoanSelect').change(function() {
                        var selectedUserId = $(this).val();

                        if (selectedUserId) {
                            $('#existingCustomer').prop('checked', true);
                            $('#newCustomer').prop('checked', false);
                        } else {
                            $('#newCustomer').prop('checked', true);
                            $('#existingCustomer').prop('checked', false);
                        }
                    });

                    if ($('#taiKhoanSelect').val()) {
                        $('#existingCustomer').prop('checked', true);
                        $('#newCustomer').prop('checked', false);
                    }
                });
                $(document).ready(function() {
                    $('#resetButton').click(function() {
                        $('#taiKhoanSelect').val('0');
                    });
                });
            });
        </script>
    @endpush
@endsection
