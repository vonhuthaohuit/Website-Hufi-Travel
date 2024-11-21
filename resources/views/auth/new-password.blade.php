@extends('frontend.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/styleNewPassword.css') }}">
@endpush
@section('renderBody')
<div class="container">
    <div class="card">
        <h1 class="title">Tạo Mật Khẩu Mới</h1>
        <p class="instruction">Vui lòng nhập mật khẩu mới của bạn để hoàn tất quá trình khôi phục tài khoản.</p>
        <form action="{{ route('auth.reset.post') }}" method="POST">
            @csrf
            <input name="token" hidden value="{{ $token }}">
            <div class="form-group">
                <label for="new-password">Mật Khẩu Mới</label>
                <input type="password" id="new-password" name="new_password" placeholder="Nhập mật khẩu mới" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Xác Nhận Mật Khẩu</label>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Xác nhận mật khẩu mới" required>
            </div>
            <button type="submit" class="btn">Cập Nhật Mật Khẩu</button>
        </form>
        <p class="note">Nếu gặp vấn đề, vui lòng liên hệ <a href="/support">bộ phận hỗ trợ</a>.</p>
    </div>
</div>
@push('script')
    <script src="{{ asset('frontend/js/scriptLogin.js') }}"></script>
@endpush
@endsection
