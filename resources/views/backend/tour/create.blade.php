loaitour@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm tour mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('tour.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('tour.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên tour</label>
                                    <input type="text" class="form-control" name="tentour" value="{{ old('tentour') }}">
                                </div>

                                <div class="form-group">
                                    <label>Mô tả tour</label>
                                    <textarea class="form-control" name="motatour">{{ old('motatour') }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Hình ảnh đại diện</label>
                                            <input type="file" class="form-control" name="hinhdaidien">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tình trạng</label>
                                            <select class="form-control" name="tinhtrang">
                                                <option value="">Chọn tình trạng</option>
                                                <option value="1">Kích hoạt</option>
                                                <option value="0">Không kích hoạt</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Thời gian đi</label>
                                            <input type="date" class="form-control" name="thoigiandi"
                                                value="{{ old('thoigiandi') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nơi khởi hành</label>
                                    <input type="text" class="form-control" name="noikhoihanh"
                                        value="{{ old('noikhoihanh') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Loại tour</label>
                                            <select class="form-control" name="loaitour_id">
                                                <option value="">Chọn loại tour</option>
                                                @foreach ($loaiTour as $loaiTourItem)
                                                    <option value="{{ $loaiTourItem->id }}">{{ $loaiTourItem->tenloai }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Khuyến mãi</label>
                                            <select class="form-control" name="khuyenmai_id">
                                                <option value="">Chọn khuyến mãi</option>
                                                @foreach ($khuyenMai as $khuyenMaiItem)
                                                    <option value="{{ $khuyenMaiItem->id }}">
                                                        {{ $khuyenMaiItem->phantramgiam }}%</option>
                                                @endforeach
                                            </select>
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
