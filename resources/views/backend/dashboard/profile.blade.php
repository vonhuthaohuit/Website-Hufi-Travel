@extends('backend.layouts.master')

@section('content')
    <style>
        label.col-form-label {
            font-size: 18px;
            /* Tăng kích thước chữ cho nhãn */
        }

        .form-control,
        .form-control-plaintext {
            font-size: 16px;
            /* Tăng kích thước chữ cho các input */
        }

        .btn {
            font-size: 18px;
            /* Tăng kích thước chữ cho nút */
        }
    </style>
    <style>
        .container {
            font-size: 18px;
            /* Tăng kích thước chữ cho toàn bộ container */
        }
    </style>

    <section class="section">
        <div class="section-header">
            <h1>Hồ sơ của tôi</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('ad.profile.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="username" class="col-md-2 col-form-label text-left"><strong>Tên đăng
                                            nhập</strong></label>
                                    <div class="col-md-10">
                                        <input type="text" id="username" class="form-control-plaintext"
                                            value="{{ @$user->tentaikhoan }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-2 col-form-label text-left"><strong>Email</strong></label>
                                    <div class="col-md-10">
                                        <input type="email" id="email" name="email" class="form-control-plaintext"
                                            required value="{{ @$user->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fullname" class="col-md-2 col-form-label text-left"><strong>Họ
                                            tên</strong></label>
                                    <div class="col-md-10">
                                        <input type="text" id="fullname" name="hoten" class="form-control"
                                            value="{{ $khachhang->hoten ?? '' }}" placeholder="Nhập tên của bạn">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-md-2 col-form-label text-left"><strong>Số điện
                                            thoại</strong></label>
                                    <div class="col-md-10">
                                        <input type="text" id="phone" name="sodienthoai" class="form-control"
                                            value="{{ $khachhang->sodienthoai ?? '' }}" placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dob" class="col-md-2 col-form-label text-left"><strong>Ngày
                                            sinh</strong></label>
                                    <div class="col-md-10">
                                        <input type="date" id="dob" name="ngaysinh" class="form-control"
                                            value="{{ @$khachhang->ngaysinh ? date('Y-m-d', strtotime(@$khachhang->ngaysinh)) : '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-md-2 col-form-label text-left"><strong>Giới
                                            tính</strong></label>
                                    <div class="col-md-10">
                                        <select id="gender" name="gioitinh" class="form-control">
                                            <option value="" disabled
                                                {{ empty(@$khachhang->gioitinh) ? 'selected' : '' }}>Chọn giới tính
                                            </option>
                                            <option value="Nam" {{ @$khachhang->gioitinh === 'Nam' ? 'selected' : '' }}>
                                                Nam</option>
                                            <option value="Nữ" {{ @$khachhang->gioitinh === 'Nữ' ? 'selected' : '' }}>Nữ
                                            </option>
                                            <option value="Khác"
                                                {{ @$khachhang->gioitinh === 'Khác' ? 'selected' : '' }}>Khác</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-2 col-form-label text-left"><strong>Bằng
                                            cấp</strong></label>
                                    <div class="col-md-10">
                                        <input type="text" id="address" name="bangcap" class="form-control"
                                            value="{{ @$khachhang->bangcap ?? '' }}" placeholder="Nhập bằng cấp">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="header text-center bg-primary text-white ">
        <h3>Hồ sơ của tôi</h3>
    </div>
    <div class="container mt-4">

    </div> --}}
@endsection
