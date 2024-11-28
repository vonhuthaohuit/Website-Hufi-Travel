@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Phương tiện</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm phương tiện mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('phuongtien.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('phuongtien.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên phương tiện</label>
                                    <input type="text" class="form-control" value="{{ old('tenphuongtien') }}" name="tenphuongtien" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sochongoi" class="block text-gray-700 font-medium mb-2">Số ghế</label>
                                            <input type="number" id="sochongoi" name="sochongoi" class="w-full p-3 border border-gray-300 rounded-lg" value="{{ old('sochongoi') }}" placeholder="Nhập số ghế của phương tiện" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sodienthoai" class="block text-gray-700 font-medium mb-2">Số điện thoại</label>
                                            <input type="tel" id="sodienthoai" name="sodienthoai" class="w-full p-3 border border-gray-300 rounded-lg" value="{{ old('sodienthoai') }}" placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="giaphuongtien" class="block text-gray-700 font-medium mb-2">Giá 1 ghế/người</label>
                                            <input type="number" id="giaphuongtien" class="w-full p-3 border border-gray-300 rounded-lg" name="giaphuongtien" value="{{ old('giaphuongtien') }}">
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
