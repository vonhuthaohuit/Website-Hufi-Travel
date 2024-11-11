@extends('backend.layouts.master')

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
                            <h4>Chỉnh sửa tour</h4>
                            <div class="card-header-action">
                                <a href="{{ route('tour.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('tour.update', $tour->matour) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $tour->matour }}" name="tourId">

                                <div class="form-group">
                                    <label>Tên Tour</label>
                                    <input type="text" class="form-control" name="tentour" value="{{ $tour->tentour }}">
                                </div>

                                <div class="form-group">
                                    <label>Mô tả Tour</label>
                                    <textarea class="form-control" name="motatour">{{ $tour->motatour }}</textarea>
                                </div>

                                <div class="row" >
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tình trạng</label>
                                            <select class="form-control" name="tinhtrang">
                                                <option value="0" {{ $tour->tinhtrang == 0 ? 'selected' : '' }}>Không
                                                    hoạt động
                                                </option>
                                                <option value="1" {{ $tour->tinhtrang == 1 ? 'selected' : '' }}>Hoạt
                                                    động
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Hình đại diện</label>
                                            <input type="file" class="form-control" name="hinhdaidien">
                                            <img src="{{ asset($tour->hinhdaidien) }}" width="100" alt="Current Image">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Thời gian đi</label>
                                            <div class="d-flex align-items-center">
                                                <input type="number" class="form-control me-2" name="thoigiandi"
                                                    style="width: 60px;" value="{{ $tour->thoigiandi }}"
                                                    placeholder="Số ngày">
                                                <span style="margin-left:20px" class="text-muted">VD : n ngày n-1 đêm</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Giá VND</label>
                                    <div class="d-flex align-items-center">
                                        <input type="number" class="form-control me-2" name="giatour"
                                            value="{{ $tour->giatour }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nơi khởi hành</label>
                                    <input type="text" class="form-control" name="noikhoihanh"
                                        value="{{ $tour->noikhoihanh }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Loại Tour</label>
                                            <select class="form-control" name="loaitour_id">
                                                @foreach ($loaiTour as $loaitour)
                                                    <option value="{{ $loaitour->maloaitour }}"
                                                        {{ $tour->matour == $loaitour->maloaitour ? 'selected' : '' }}>
                                                        {{ $loaitour->tenloai }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Khuyến mãi</label>
                                            <select class="form-control" name="khuyenmai_id">
                                                @foreach ($khuyenMai as $khuyenmai)
                                                    <option value="{{ $khuyenmai->makhuyenmai }}"
                                                        {{ $tour->matour == $khuyenmai->makhuyenmai ? 'selected' : '' }}>
                                                        {{ $khuyenmai->phantramgiam }}%
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngày tạo</label>
                                            <input type="datetime-local" class="form-control" name="ngaytao"
                                                value="{{ $tour->ngaytao }}">
                                        </div>
                                    </div> --}}
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
