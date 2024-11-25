@extends('frontend.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/styleNewPassword.css') }}">
@endpush

@section('renderBody')
    <div class="container">
        <div class="card">
            <h1 class="title">Tạo Mật Khẩu Mới</h1>
            <p class="instruction">Vui lòng nhập mật khẩu mới của bạn để hoàn tất quá trình khôi phục tài khoản.</p>
            <form action="{{ route('auth.reset.post') }}" id="resetForm" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="new-password">Mật Khẩu Mới</label>
                    <input type="password" id="new-password" name="new_password" placeholder="Nhập mật khẩu mới" required
                        minlength="8">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Xác Nhận Mật Khẩu</label>
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Xác nhận mật khẩu mới"
                        required>
                </div>
                <button type="submit" class="btn-new">Cập Nhật Mật Khẩu</button>
            </form>
            <p class="note">Nếu gặp vấn đề, vui lòng liên hệ <a href="{{ route('home') }}">bộ phận hỗ trợ</a>.</p>
        </div>
    </div>
@endsection

@push('script')
    {{-- <script src="{{ asset('frontend/js/scriptLogin.js') }}"></script> --}}
    <script>
        // Hàm kiểm tra mật khẩu trùng khớp
        function validatePasswordMatch(password, confirmPassword) {
            if (password !== confirmPassword) {
                return 'Mật khẩu xác nhận không khớp.';
            }
            return null;
        }

        document.getElementById('new-password')?.addEventListener('blur', function() {
            console.log('Sự kiện blur hoạt động');
            const password = this.value;
            const passwordError = validatePassword(password);
            if (passwordError) {
                toastr.error(passwordError, 'Lỗi');
            }
        })

        // Xử lý form reset mật khẩu
        document.getElementById('resetForm')?.addEventListener('submit', function(event) {
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            // Kiểm tra mật khẩu trùng khớp
            const errorMessage = validatePasswordMatch(newPassword, confirmPassword);
            if (errorMessage) {
                toastr.error(errorMessage, 'Lỗi');
                event.preventDefault();
                return;
            }


        });
    </script>
@endpush
