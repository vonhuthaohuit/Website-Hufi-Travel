@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hóa đơn</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sửa hóa đơn</h4>
                            <div class="card-header-action">
                                <a href="{{ route('hoadon.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('hoadon.update', $hoadon->mahoadon) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" hidden value="{{ $hoadon->phieudattour->tour->matour }}"
                                    name="tourid">
                                <div class="form-group">
                                    <label for="mahoadon">Mã hoá đơn</label>
                                    <input readonly type="text" name="mahoadon" id="mahoadon" class="form-control"
                                        value="{{ number_format($hoadon->mahoadon) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="tongsotien">Tổng số tiền</label>
                                    <input readonly type="number" name="tongsotien" id="tongsotien" class="form-control"
                                        value="{{ $hoadon->tongsotien }}" required>

                                </div>
                                <div class="form-group">
                                    <label for="phuongthucthanhtoan">Phương thức thanh toán</label>
                                    <select name="phuongthucthanhtoan" id="phuongthucthanhtoan" class="form-control"
                                        required>
                                        <option value="Thanh toán trực tiếp"
                                            {{ $hoadon->phuongthucthanhtoan == 'Thanh toán trực tiếp' ? 'selected' : '' }}>
                                            Tiền
                                            mặt</option>
                                        <option value="Chuyển khoản"
                                            {{ $hoadon->phuongthucthanhtoan == 'Chuyển khoản' ? 'selected' : '' }}>Chuyển
                                            khoản
                                        </option>
                                        <option value="Thanh toán online VNPay"
                                            {{ $hoadon->phuongthucthanhtoan == 'Thanh toán online VNPay' ? 'selected' : '' }}>
                                            Thanh
                                            toán online VNPay
                                        </option>
                                        <option value="Thanh toán online Momo"
                                            {{ $hoadon->phuongthucthanhtoan == 'Thanh toán online Momo' ? 'selected' : '' }}>
                                            Thanh
                                            toán
                                            online Momo
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for = "trangthaithanhtoan">Trạng thái thanh toán</label>
                                    <select name="trangthaithanhtoan" id="trangthaithanhtoan" class="form-control" required>
                                        <option value="Chưa thanh toán"
                                            {{ $hoadon->trangthaithanhtoan == 'Chưa thanh toán' ? 'selected' : '' }}>Chưa
                                            thanh toán
                                        </option>
                                        <option value="Đã thanh toán"
                                            {{ $hoadon->trangthaithanhtoan == 'Đã thanh toán' ? 'selected' : '' }}>Đã thanh
                                            toán
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ngaythanhtoan">Ngày thanh toán</label>
                                    <input type="date" name="ngaythanhtoan" id="ngaythanhtoan" class="form-control"
                                        value="{{ isset($hoadon->created_at) ? \Carbon\Carbon::parse($hoadon->created_at)->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        required>
                                </div>

                                <div class="customer-container">
                                    <h4 class="my-4"><strong>Danh sách khách hàng đi tour</strong></h4>
                                    @foreach ($hoadon->phieudattour->chitietphieudattour as $index => $chiTiet)
                                        <input hidden name="khachhang[{{ $index }}][maphieudattour]" type="text"
                                            value="{{ $chiTiet->maphieudattour }}">
                                        <div>
                                            <h5>
                                               Khách hàng thứ {{ $index + 1 }}
                                            </h5>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <label for="hoten_{{ $index }}">Họ tên</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input name="khachhang[{{ $index }}][hoten]" type="text"
                                                        class="form-control text-truncate"
                                                        value="{{ $chiTiet->khachhang->hoten }}" required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <label for="cccd_{{ $index }}">Căn cước công dân</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input name="khachhang[{{ $index }}][cccd]" type="text"
                                                        class="form-control text-truncate"
                                                        value="{{ $chiTiet->khachhang->cccd }}" required
                                                        pattern="^\d{9,12}$" minlength="9" maxlength="12"
                                                        oninput="validateNumber(this)">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <label for="sodienthoai_{{ $index }}">Số điện thoại</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input name="khachhang[{{ $index }}][sodienthoai]"
                                                        type="text" class="form-control text-truncate"
                                                        value="{{ $chiTiet->khachhang->sodienthoai }}" required
                                                        pattern="^\d{10}$" minlength="10" maxlength="10"
                                                        oninput="validateNumber(this)">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <label for="sodienthoai_{{ $index }}">Giới tính</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <select name="khachhang[{{ $index }}][gioitinh]"
                                                        class="form-control" required>
                                                        <option value="Nam"
                                                            {{ $chiTiet->khachhang->gioitinh == 'Nam' ? 'selected' : '' }}>
                                                            Nam
                                                        </option>
                                                        <option value="Nữ"
                                                            {{ $chiTiet->khachhang->gioitinh == 'Nữ' ? 'selected' : '' }}>
                                                            Nữ
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <label for="ngaysinh_{{ $index }}">Ngày sinh</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input name="khachhang[{{ $index }}][ngaysinh]" type="date"
                                                        class="form-control text-truncate"
                                                        value="{{ $chiTiet->khachhang->ngaysinh }}" required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <label for="tenloaikhachhang_{{ $index }}">Loại khách
                                                        hàng</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input readonly
                                                        name="khachhang[{{ $index }}][tenloaikhachhang]"
                                                        type="text" class="form-control text-truncate"
                                                        value="{{ $chiTiet->khachhang->loaikhachhang->tenloaikhachhang }}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <label for="chitietsotiendat_{{ $index }}">Mức áp dụng
                                                        giá</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input readonly
                                                        name="khachhang[{{ $index }}][chitietsotiendat]"
                                                        type="text" class="form-control text-truncate"
                                                        value="{{ number_format($chiTiet->chitietsotiendat) }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="submit" class="btn btn-primary">Sửa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa hóa đơn</h2>
                <form action="{{ route('hoadon.update', $hoadon->mahoadon) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" hidden value="{{ $hoadon->phieudattour->tour->matour }}" name="tourid">
                    <div class="form-group">
                        <label for="mahoadon">Mã hoá đơn</label>
                        <input readonly type="text" name="mahoadon" id="mahoadon" class="form-control"
                            value="{{ number_format($hoadon->mahoadon) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tongsotien">Tổng số tiền</label>
                        <input readonly type="number" name="tongsotien" id="tongsotien" class="form-control"
                            value="{{ $hoadon->tongsotien }}" required>

                    </div>
                    <div class="form-group">
                        <label for="phuongthucthanhtoan">Phương thức thanh toán</label>
                        <select name="phuongthucthanhtoan" id="phuongthucthanhtoan" class="form-control" required>
                            <option value="Thanh toán trực tiếp"
                                {{ $hoadon->phuongthucthanhtoan == 'Thanh toán trực tiếp' ? 'selected' : '' }}>Tiền
                                mặt</option>
                            <option value="Chuyển khoản"
                                {{ $hoadon->phuongthucthanhtoan == 'Chuyển khoản' ? 'selected' : '' }}>Chuyển khoản
                            </option>
                            <option value="Thanh toán online VNPay"
                                {{ $hoadon->phuongthucthanhtoan == 'Thanh toán online VNPay' ? 'selected' : '' }}>Thanh
                                toán online VNPay
                            </option>
                            <option value="Thanh toán online Momo"
                                {{ $hoadon->phuongthucthanhtoan == 'Thanh toán online Momo' ? 'selected' : '' }}>Thanh
                                toán
                                online Momo
                            </option>
                        </select>
                    </div>
                    <div class="from-group">
                        <label for = "trangthaithanhtoan">Trạng thái thanh toán</label>
                        <select name="trangthaithanhtoan" id="trangthaithanhtoan" class="form-control" required>
                            <option value="Chưa thanh toán"
                                {{ $hoadon->trangthaithanhtoan == 'Chưa thanh toán' ? 'selected' : '' }}>Chưa thanh toán
                            </option>
                            <option value="Đã thanh toán"
                                {{ $hoadon->trangthaithanhtoan == 'Đã thanh toán' ? 'selected' : '' }}>Đã thanh toán
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ngaythanhtoan">Ngày thanh toán</label>
                        <input type="date" name="ngaythanhtoan" id="ngaythanhtoan" class="form-control"
                            value="{{ isset($hoadon->created_at) ? \Carbon\Carbon::parse($hoadon->created_at)->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d') }}"
                            required>
                    </div>
                    <h4>Danh sách khách hàng đi tour</h4>
                    <div class="container customer-container">
                        @foreach ($hoadon->phieudattour->chitietphieudattour as $index => $chiTiet)
                            <input hidden name="khachhang[{{ $index }}][maphieudattour]" type="text"
                                value="{{ $chiTiet->maphieudattour }}">
                            <div>
                                <h3>
                                    <strong>Khách hàng thứ {{ $index + 1 }}</strong>
                                </h3>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <label for="hoten_{{ $index }}">Họ tên</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input name="khachhang[{{ $index }}][hoten]" type="text"
                                            class="form-control text-truncate" value="{{ $chiTiet->khachhang->hoten }}"
                                            required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <label for="cccd_{{ $index }}">Căn cước công dân</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input name="khachhang[{{ $index }}][cccd]" type="text"
                                            class="form-control text-truncate" value="{{ $chiTiet->khachhang->cccd }}"
                                            required pattern="^\d{9,12}$" minlength="9" maxlength="12"
                                            oninput="validateNumber(this)">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <label for="sodienthoai_{{ $index }}">Số điện thoại</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input name="khachhang[{{ $index }}][sodienthoai]" type="text"
                                            class="form-control text-truncate"
                                            value="{{ $chiTiet->khachhang->sodienthoai }}" required pattern="^\d{10}$"
                                            minlength="10" maxlength="10" oninput="validateNumber(this)">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <label for="sodienthoai_{{ $index }}">Giới tính</label>
                                    </div>
                                    <div class="col-md-10">
                                        <select name="khachhang[{{ $index }}][gioitinh]" class="form-control"
                                            required>
                                            <option value="Nam"
                                                {{ $chiTiet->khachhang->gioitinh == 'Nam' ? 'selected' : '' }}>Nam
                                            </option>
                                            <option value="Nữ"
                                                {{ $chiTiet->khachhang->gioitinh == 'Nữ' ? 'selected' : '' }}>Nữ
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <label for="ngaysinh_{{ $index }}">Ngày sinh</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input name="khachhang[{{ $index }}][ngaysinh]" type="date"
                                            class="form-control text-truncate"
                                            value="{{ $chiTiet->khachhang->ngaysinh }}" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <label for="tenloaikhachhang_{{ $index }}">Loại khách hàng</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input readonly name="khachhang[{{ $index }}][tenloaikhachhang]"
                                            type="text" class="form-control text-truncate"
                                            value="{{ $chiTiet->khachhang->loaikhachhang->tenloaikhachhang }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <label for="chitietsotiendat_{{ $index }}">Mức áp dụng giá</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input readonly name="khachhang[{{ $index }}][chitietsotiendat]"
                                            type="text" class="form-control text-truncate"
                                            value="{{ number_format($chiTiet->chitietsotiendat) }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </form>
            </div>
        </div>
    </div> --}}

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const requiredFields = document.querySelectorAll('input[required], select[required]');

                requiredFields.forEach(field => {
                    field.addEventListener('blur', function() {
                        if (!field.value.trim()) {
                            showError(field,
                                `${field.previousElementSibling.innerText} không được để trống.`);
                        } else {
                            clearError(field);
                        }
                    });
                });

                function showError(element, message) {
                    clearError(element);
                    const error = document.createElement('div');
                    error.className = 'invalid-feedback d-block';
                    error.innerText = message;
                    element.classList.add('is-invalid');
                    element.parentElement.appendChild(error);
                }

                function clearError(element) {
                    element.classList.remove('is-invalid');
                    const error = element.parentElement.querySelector('.invalid-feedback');
                    if (error) {
                        error.remove();
                    }
                }

                document.querySelectorAll('input[name^="khachhang["][name$="[sodienthoai]"]').forEach(input => {
                    input.addEventListener('input', function() {
                        const phoneRegex = /^\d{10}$/;
                        if (!phoneRegex.test(this.value)) {
                            showError(this, 'Số điện thoại phải là 10 chữ số.');
                        } else {
                            clearError(this);
                        }
                    });
                });

                document.querySelectorAll('input[name^="khachhang["][name$="[cccd]"]').forEach(input => {
                    input.addEventListener('input', function() {
                        const cccdRegex = /^\d{9,12}$/;
                        if (!cccdRegex.test(this.value)) {
                            showError(this, 'CCCD phải có từ 9 đến 12 chữ số.');
                        } else {
                            clearError(this);
                        }
                    });
                });

                document.querySelectorAll('input[name^="khachhang["][name$="[ngaysinh]"]').forEach(input => {
                    input.addEventListener('change', function() {
                        const birthday = new Date(this.value);
                        const today = new Date();
                        let age = today.getFullYear() - birthday.getFullYear();

                        if (today < new Date(today.getFullYear(), birthday.getMonth(), birthday
                                .getDate())) {
                            age--;
                        }

                        const tourId = document.querySelector('input[name="tourid"]').value;

                        fetch(`/get-customer-price/${age}/${tourId}`)
                            .then(response => response.json())
                            .then(data => {
                                const container = this.closest('.customer-container');
                                const priceInput = container.querySelector(
                                    'input[name^="khachhang["][name$="[chitietsotiendat]"]');
                                priceInput.value = data.price;

                                const customerTypeInput = container.querySelector(
                                    'input[name^="khachhang["][name$="[tenloaikhachhang]"]');
                                customerTypeInput.value = data.customerType;

                                updateTotalAmount();
                            })
                            .catch(error => console.error('Error:', error));
                    });
                });

                function validateNumber(input) {
                    input.value = input.value.replace(/[^0-9]/g, '');

                    const minLength = 9;
                    const maxLength = 12;
                    if (input.name.includes('sodienthoai') && input.value.length !== 10) {
                        input.setCustomValidity("Số điện thoại phải là 10 chữ số.");
                    } else if (input.name.includes('cccd') && (input.value.length < minLength || input.value.length >
                            maxLength)) {
                        input.setCustomValidity(`CCCD phải có từ ${minLength} đến ${maxLength} chữ số.`);
                    } else {
                        input.setCustomValidity('');
                    }
                }

                function updateTotalAmount() {
                    let totalAmount = 0;

                    document.querySelectorAll('input[name^="khachhang["][name$="[chitietsotiendat]"]')
                        .forEach(input => {
                            totalAmount += parseFloat(input.value) || 0;
                        });

                    const totalAmountInput = document.querySelector('input[name="tongsotien"]');
                    totalAmountInput.value = totalAmount;
                }
            });
        </script>
    @endpush
@endsection
