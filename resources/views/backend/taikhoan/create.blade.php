@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tài khoản</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm tài khoản mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('taikhoannv.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('taikhoannv.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Tên tài khoản</label>
                                    <input type="text" class="form-control" name="tentaikhoan"
                                        value="{{ old('tentaikhoan') }}" placeholder="Nhập tên tài khoản">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                                        placeholder="Nhập email">
                                </div>

                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" class="form-control" name="matkhau" placeholder="Nhập mật khẩu">
                                </div>

                                <div class="form-group">
                                    <label>Trạng thái tài khoản</label>
                                    <select class="form-control" name="trangthai">
                                        <option value="">Chọn tình trạng</option>
                                        <option value="Hoạt động">Hoạt động</option>
                                        <option value="Khóa">Khóa</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Tạo mới</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Any additional JavaScript can go here
        });
    </script>
@endpush
