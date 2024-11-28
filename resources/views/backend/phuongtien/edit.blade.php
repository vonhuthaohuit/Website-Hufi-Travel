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
                            <h4>Chỉnh sửa thông tin phương tiện</h4>
                            <div class="card-header-action">
                                <a href="{{ route('phuongtien.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>Quay về
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('phuongtien.update', $phuongtien->maphuongtien) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $phuongtien->maphuongtien }}" name="maphuongtien">
                                <<div class="form-group">
                                    <label>Tên phương tiện</label>
                                    <input type="text" class="form-control" value="{{ $phuongtien->tenphuongtien }}" name="tenphuongtien" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sochongoi" class="block text-gray-700 font-medium mb-2">Số ghế</label>
                                            <input type="number" id="sochongoi" name="sochongoi" class="w-full p-3 border border-gray-300 rounded-lg" value="{{ $phuongtien->sochongoi }}" placeholder="Nhập số ghế của phương tiện" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sodienthoai" class="block text-gray-700 font-medium mb-2">Số điện thoại</label>
                                            <input type="tel" id="sodienthoai" name="sodienthoai" class="w-full p-3 border border-gray-300 rounded-lg" value="{{ $phuongtien->sodienthoai }}" placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="giaphuongtien" class="block text-gray-700 font-medium mb-2">Giá 1 ghế/người</label>
                                            <input type="number" id="giaphuongtien" class="w-full p-3 border border-gray-300 rounded-lg" name="giaphuongtien" value="{{ $phuongtien->giaphuongtien }}">
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
