@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ asset('frontend/css/style_dattour.css') }}">
@section('renderBody')
    <div class="container-xl mt-5">
        <form name="tourBooking" method="post" class="form-horizontal frm-tour-booking" id="form-booking"
            novalidate="novalidate">
            <input type="hidden" value="2,990,000" id="tour_price">
            <div class="panel panel-1">
                <input type="hidden" id="hd_ticket" value="12">
                <input type="hidden" id="hd_tour_price" value="2290000">
                <ul class="nav nav-justified frm-tour-booking-step mb-4" role="tablist">
                    <li role="presentation" class="active"><b>Chọn tour</b><i class="fa fa-check"></i></li>
                    <li role="presentation" class="active"><b>Đăng ký tour</b><i class="fa fa-check"></i></li>
                    <li role="presentation"><b>Xác nhận thông tin</b><i class="fa fa-times"></i></li>
                    <li role="presentation"><b>Hoàn thành</b><i class="fa fa-times"></i></li>
                </ul>
                <!-- info tour -->
                <div class="content_book tour-des">
                    <header class="content-header">
                        <h3>Thông tin tour</h3>
                    </header>
                    <div class="content-body">
                        <p><b>Tour Du Lịch Nha Trang - Đà Lạt 5 Ngày 4 Đêm: Cung Đường Nối Biển Và Hoa</b></p>
                        <p>Mã tour: DL5N4D</p>
                        <p>Thời gian: 5 ngày </p>
                        <p>Ngày khởi hành: Đang cập nhật</p>
                        <p>Nơi khởi hành: TP.HCM</p>
                    </div>
                </div>
                <!-- tour price -->
                <div class="content_book tour-price-advance">
                    <header class="content-header">
                        <h3>Giá tour</h3>
                    </header>
                    <div class="content-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Loại khách</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Người lớn </td>
                                    <td>2,290,000 VND</td>
                                </tr>

                                <tr>
                                    <td>
                                        Trẻ em (5 -11 tuổi) </td>
                                    <td>1,790,000 VND</td>
                                </tr>

                                <tr>
                                    <td>
                                        Trẻ em( &lt; 5 tuổi) </td>
                                    <td>0 VND</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- info customer -->
                <div class="content_book customers-info">
                    <header class="content-header">
                        <h3>Thông tin liên lạc</h3>
                    </header>
                    <div class="content-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Họ &amp; Tên <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="ticket_fullname" value=""
                                    required="" data-msg="Trường này là bắt buộc!">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Địa chỉ <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="ticket_address" value=""
                                    required="" data-msg="Trường này là bắt buộc!">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Điện thoại <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="ticket_phone" value=""
                                            required="" data-msg="Trường này là bắt buộc!">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" name="ticket_email" value=""
                                            required="" data-msg="Trường này là bắt buộc!"
                                            data-msg-email="Email không đúng định dạng!">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Di động (<span class="error">*</span>)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="" name="ticket_hotline"
                                            value=""
                                            required data-msg="Trường này là bắt buộc!">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea name="ticket_note" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="content_book">
                            <header class="content-header">
                                <h3>Danh sách khách hàng đi tour</h3>
                            </header>
                            <div class="content-body table-responsive">
                                <table class="table table-striped" id="customerTable">
                                    <thead>
                                        <tr>
                                            <th>Họ tên <span class="text-danger">*</span></th>
                                            <th>Ngày sinh <span class="text-danger">*</span></th>
                                            <!-- <th>Địa chỉ</th> -->
                                            <th style="width:90px">Giới tính</th>
                                            <th>Khách hàng</th>
                                            <!-- <th >Độ tuổi</th> -->
                                            <th>Giá</th>
                                            <th style="text-align: right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_plus_tbd">
                                        <tr id="customerRowTemplate" style="display: none;">
                                            <td>
                                                <input type="hidden" class="form-control" name="stt"
                                                    value="1">
                                                <input type="text" class="form-control" name="td_ticket[1][td_name]"
                                                    placeholder="Tên" required="">
                                            </td>
                                            <td><input type="text" class="form-control"
                                                    name="td_ticket[1][td_birthday]" placeholder="01/01/1990"
                                                    required=""></td>
                                            <td>
                                                <select name="td_ticket[1][td_gender]" class="form-control">
                                                    <option value="Nam">Nam</option>
                                                    <option value="Nữ">Nữ</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="td_ticket[1][td_loaikhach]"
                                                    class="form-control js-type-customer">
                                                    <option data-price="2290000" value="1">Người lớn</option>
                                                    <option data-price="1790000" value="2">Trẻ em (5 -11 tuổi)
                                                    </option>
                                                    <option data-price="0" value="3">Trẻ em (&lt; 5 tuổi)</option>
                                                </select>
                                            </td>
                                            <td class="price-cell">
                                                <input type="hidden" class="form-control js-input-price" id="td_price_1"
                                                    name="td_ticket[1][td_price]" value="2290000">
                                                <span class="td-price">2,290,000</span>
                                            </td>
                                            <td align="right" class="action-cell">
                                                <a class="text-danger" href="javascript:;" onclick="removeCustomer(this)"
                                                    title="Xóa">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="add_plus_tr">
                                            <td>
                                                <input type="hidden" class="form-control" name="stt"
                                                    value="1">
                                                <input type="text" class="form-control" id="td_name_1"
                                                    name="td_ticket[1][td_name]" placeholder="Tên" required=""
                                                    data-msg="Trường này là bắt buộc!">
                                            </td>
                                            <td><input type="text" class="form-control" id="td_birthday_1"
                                                    name="td_ticket[1][td_birthday]" placeholder="01/01/1990"
                                                    required="" data-msg="Trường này là bắt buộc!"></td>
                                            <td>
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
                                                    <option data-price="2290000" data-price_other="1100000"
                                                        value="1">Người lớn</option>
                                                    <option data-price="1790000" data-price_other="1100000"
                                                        value="2">Trẻ em (5 -11 tuổi) </option>
                                                    <option data-price="0" data-price_other="0" value="3">Trẻ em(
                                                        &lt; 5 tuổi)</option>
                                                </select>
                                            </td>
                                            <td class="price-cell">
                                                <input type="hidden" class="form-control js-input-price" id="td_price_1"
                                                    name="td_ticket[1][td_price]" value="2290000">
                                                <span class="td-price">2,290,000</span>
                                            </td>
                                            <td align="right" class="action-cell">
                                                <a class="text-danger" href="javascript:;" onclick="removeCustomer(this)"
                                                    title="Xóa">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div style="text-align: right">
                                    <button type="button" id="btn-add-more-customer" class="btn btn-info">
                                        <i class="fa fa-plus"></i> Thêm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content_book payment">
                    <header class="content-header">
                        <h3>Phương thức thanh toán</h3>
                    </header>
                    <div class="content-body">
                        <div class="radio"><label><input type="radio" name="payment_id" value="1"
                                    checked="checked" class="payment-banking">Thanh toán trực tiếp<ul>
                                    <p><strong>CÔNG TY CỔ PHẦN VIETOURIST HOLDINGS</strong><br>
                                        <strong>Địa chỉ:</strong>&nbsp;95B-97-99 Trần Hưng Đạo, Phường Cầu Ông Lãnh, Quận 1,
                                        Tp. Hồ Chí Minh<br>
                                        <strong>Điện thoại:</strong> 028. 62 61 63 65<br>
                                        <strong>Hotline:&nbsp;</strong>089 990 9145
                                    </p>
                                </ul></label></div>
                        <div class="radio"><label><input type="radio" name="payment_id" value="2"
                                    class="payment-banking">Thanh toán chuyển khoản<ul>
                                    <p style="text-align: justify;"><span style="font-size:14px">VIETOURIST HOLDINGS JOINT
                                            STOCK CO.<span style="color:rgb(0, 26, 51)"> </span></span></p>

                                    <p style="text-align: justify;"><span style="font-size:14px">STK: 1601100633008<span
                                                style="color:rgb(0, 26, 51)"> </span></span></p>

                                    <p style="text-align: justify;"><span style="font-size:14px">Ngân hàng Quân Đội (MB) -
                                            CN Kỳ Đồng</span></p>
                                </ul></label></div>
                    </div>
                </div>
                <div class="content_book payment">
                    <header class="content-header">
                        <h3>Điều khoản</h3>
                    </header>
                    <div class="content-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-1 col-md-1 col-sm-1 col-xs-2 control-label"></label>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                <input type="radio" id="toi_dong_y2" checked=""> Tôi đã đọc và đồng ý các điều
                                khoản quy định công ty.
                            </div>
                        </div>
                        <div>
                            <button type="submit" id="tour_tep1" name="tour_tep1" value="tour_tep1"
                                class="btn btn-primary">Đặt tour</button>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger" style="margin-top:20px;">
                    <p style="font-size: 12px;">(<span class="error">*</span>): Thông tin bắt buộc</p>
                </div>

            </div>
        </form>

    </div>


    <script>
        document.getElementById('btn-add-more-customer').addEventListener('click', function() {
            // Lấy hàng mẫu
            var rowTemplate = document.getElementById('customerRowTemplate');
            // Sao chép hàng mẫu
            var newRow = rowTemplate.cloneNode(true);
            newRow.style.display = ''; // Hiện hàng mới

            // Cập nhật tên và id của các input trong hàng mới
            var index = document.querySelectorAll('#customerTable tbody tr').length + 1; // Tính toán chỉ số mới
            newRow.querySelector('input[name="td_ticket[1][td_name]"]').name = `td_ticket[${index}][td_name]`;
            newRow.querySelector('input[name="td_ticket[1][td_birthday]"]').name =
                `td_ticket[${index}][td_birthday]`;
            newRow.querySelector('select[name="td_ticket[1][td_gender]"]').name = `td_ticket[${index}][td_gender]`;
            newRow.querySelector('select[name="td_ticket[1][td_loaikhach]"]').name =
                `td_ticket[${index}][td_loaikhach]`;
            newRow.querySelector('input[name="td_ticket[1][td_price]"]').name = `td_ticket[${index}][td_price]`;

            // Cập nhật giá trị cho input ẩn
            newRow.querySelector('.js-input-price').value = "2290000"; // Cập nhật giá mới nếu cần

            // Thay đổi giá hiển thị nếu cần
            newRow.querySelector('.td-price').innerText = "2,290,000"; // Cập nhật hiển thị nếu cần

            // Thêm hàng mới vào bảng
            document.querySelector('#customerTable tbody').appendChild(newRow);
        });

        function removeCustomer(element) {
            var row = element.closest('tr');
            row.remove(); // Xóa hàng
        }
    </script>
@endsection
