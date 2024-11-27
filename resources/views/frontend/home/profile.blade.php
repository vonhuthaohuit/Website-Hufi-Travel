@extends('frontend.layouts.history')

@section('content-history')
    <div class="container-xl">
        <h3 class="mb-3">Hồ sơ của tôi</h3>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="tentaikhoan"><strong>Tên đăng nhập</strong></label>
                </div>
                <div class="col-md-9">
                    <p>{{ @$user->tentaikhoan }}</p>
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col-md-3">
                    <label for="email"><strong>Email</strong></label>
                </div>
                <div class="col-md-9">
                    <p>{{ @$user->email }}</p>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="hoten"><strong>Họ tên</strong></label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="hoten" name="hoten"
                        value="{{ @$khachhang->hoten ?? '' }}" placeholder="Nhập tên của bạn">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="sodienthoai"><strong>Số điện thoại</strong></label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="sodienthoai" name="sodienthoai"
                        value="{{ @$khachhang->sodienthoai ?? '' }}" placeholder="Nhập số điện thoại">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="ngaysinh"><strong>Ngày sinh</strong></label>
                </div>
                <div class="col-md-9">
                    <input type="date" class="form-control" id="ngaysinh" name="ngaysinh"
                        value="{{ @$khachhang->ngaysinh ? date('Y-m-d', strtotime(@$khachhang->ngaysinh)) : '' }}"
                        placeholder="Nhập ngày sinh">
                </div>

            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="gioitinh"><strong>Giới tính</strong></label>
                </div>
                <div class="col-md-9">
                    <select class="form-control" id="gioitinh" name="gioitinh">
                        <option value="" disabled {{ empty(@$khachhang->gioitinh) ? 'selected' : '' }}>Chọn giới tính</option>
                        <option value="Nam" {{ @$khachhang->gioitinh === 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ @$khachhang->gioitinh === 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ @$khachhang->gioitinh === 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col-md-3">
                    <label for="diachi"><strong>Địa chỉ</strong></label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="diachi" name="diachi"
                        value="{{ @$khachhang->diachi ?? '' }}" placeholder="Nhập địa chỉ">
                </div>
            </div>

            {{-- <div class="form-group row mb-3">
                <div class="col-md-3">
                    <label for="hinhdaidien"><strong>Hình đại diện</strong></label>
                </div>
                <div class="col-md-9">
                    <input type="file" class="form-control" id="hinhdaidien" name="hinhdaidien"
                        value="{{ $khachhang->hinhdaidien ?? '' }}" >
                </div>
            </div> --}}

            <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
        </form>
    </div>
@endsection
