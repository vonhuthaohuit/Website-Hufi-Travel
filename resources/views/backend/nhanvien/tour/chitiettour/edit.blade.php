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
                            <h4>Chỉnh sửa chi tiết tour</h4>
                            <div class="card-header-action">
                                <a href="{{ route('chitiettour.index',['tour_id'=>$chitiettour->matour]) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('chitiettour.update', $chitiettour->matour) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $chitiettour->matour }}" name="tour_id">
                                <input type="hidden" value="{{ $chitiettour->madiemdulich }}" name="madiemdulich">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Thời gian bắt đầu</label>
                                            <input type="date" class="form-control" name="ngaybatdau"
                                                value="{{ $chitiettour->ngaybatdau }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Thời gian đi</label>
                                            <input type="text" class="form-control" name="ngayketthuc" readonly
                                                value="{{ $chitiettour->tour->thoigiandi }} ngày {{ $chitiettour->tour->thoigiandi - 1  }} đêm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Giá</label>
                                            <input type="text" class="form-control" name="gia" required value="{{ $chitiettour->giachitiettour }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Điểm du lịch</label>
                                            <p>{{ $chitiettour->diemdulich->tendiemdulich }}</p>
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
