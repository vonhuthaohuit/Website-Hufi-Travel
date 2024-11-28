@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Khách sạn</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa thông tin khách sạn</h4>
                            <div class="card-header-action">
                                <a href="{{ route('khachsan.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>Quay về
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('khachsan.update', $khachsan->makhachsan) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $khachsan->makhachsan }}" name="makhachsan">
                                <div class="form-group">
                                    <label>Tên khách sạn</label>
                                    <input type="text" class="form-control" value="{{ $khachsan->tenkhachsan }}" name="tenkhachsan" required>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ của khách sạn</label>
                                    <input type="text" class="form-control" name="diachi" value="{{ $khachsan->diachi }}" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone" class="block text-gray-700 font-medium mb-2">Số điện thoại</label>
                                            <input type="tel" id="phone" name="sodienthoai" class="w-full p-3 border border-gray-300 rounded-lg" value="{{$khachsan->sodienthoai }}"placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quality" class="block text-gray-700 font-medium mb-2">Quality</label>
                                                <select id="quality" name="chatluong" class="w-full p-3 border border-gray-300 rounded-lg" required>
                                                    <option value="" disabled selected>{{ $khachsan->chatluong }} start</option>
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
                                                value="{{ $khachsan->giakhachsan }}">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

{{-- @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush --}}
