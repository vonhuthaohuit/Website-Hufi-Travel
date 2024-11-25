@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Blog Categoty</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm khách sạn mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('khachsan.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('khachsan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên khách sạn</label>
                                    <input type="text" class="form-control" value="{{ old('tenkhachsan') }}" name="tenkhachsan" required>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ của khách sạn</label>
                                    <input type="text" class="form-control" name="diachi" value="{{ old('diachi') }}" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone" class="block text-gray-700 font-medium mb-2">Số điện thoại</label>
                                            <input type="tel" id="phone" name="sodienthoai" class="w-full p-3 border border-gray-300 rounded-lg" value="{{ old('sodienthoai') }}"placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quality" class="block text-gray-700 font-medium mb-2">Quality</label>
                                                <select id="quality" name="chatluong" class="w-full p-3 border border-gray-300 rounded-lg" required>
                                                    <option value="" disabled selected>Chọn chất lượng</option>
                                                    <option value="1">1 Star</option>
                                                    <option value="2">2 Stars</option>
                                                    <option value="3">3 Stars</option>
                                                    <option value="4">4 Stars</option>
                                                    <option value="5">5 Stars</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Giá khách sạn cho 1 người</label>
                                            <input type="number" class="form-control" name="giakhachsan"
                                                value="{{ old('giakhachsan') }}">
                                        </div>
                                    </div>
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
