@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Coupons</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa khuyến mãi</h4>
                            <div class="card-header-action">
                                <a href="{{ route('khuyenmai.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('khuyenmai.update', $khuyenmai->makhuyenmai) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $khuyenmai->makhuyenmai }}" name="khuyenmaiId">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Thời gian bắt đầu</label>
                                            <input type="date" class="form-control" name="thoigianbatdau"
                                            value="{{ $khuyenmai->thoigianbatdau }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Thời gian kết thúc</label>
                                            <input type="date" class="form-control" name="thoigianketthuc"
                                            value="{{ $khuyenmai->thoigianketthuc }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phần trăm giảm</label>
                                            <input type="text" class="form-control" name="phantramgiam" value="{{ $khuyenmai->phantramgiam }}">
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
