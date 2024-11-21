@extends('backend.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Sửa hóa đơn</h2>
            <form action="" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="maphieudattour">Mã phiếu đặt tour</label>
                    <input type="text" name="maphieudattour" id="maphieudattour" class="form-control" value="{{ $hoadon->maphieudattour }}" required>
                </div>
                <div class="form-group">
                    <label for="tongsotien">Tổng số tiền</label>
                    <input type="number" name="tongsotien" id="tongsotien" class="form-control" value="{{ $hoadon->tongsotien }}" required>
                </div>
                <div class="form-group">
                    <label for="phuongthucthanhtoan">Phương thức thanh toán</label>
                    <input type="text" name="phuongthucthanhtoan" id="phuongthucthanhtoan" class="form-control" value="{{ $hoadon->phuongthucthanhto
