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
                            <h4>Chỉnh sửa chương trình tour</h4>
                            <div class="card-header-action">
                                <a href="{{ route('chuongtrinhtour.index',['tour_id'=>$chuongtrinhtour->matour]) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('chuongtrinhtour.update', $chuongtrinhtour->machuongtrinhtour) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $chuongtrinhtour->matour }}" name="tour_id">
                                <input type="hidden" value="{{ $chuongtrinhtour->machuongtrinh }}" name="chuongtrinhtour_id">

                                <div class="form-group">
                                    <label>Tên Tour</label>
                                    <input type="text" class="form-control" name="tieude" value="{{ $chuongtrinhtour->tieude }}">
                                </div>

                                <div class="form-group">
                                    <label>Mô tả Tour</label>
                                    <textarea class="form-control summernote"  name="mota">{{ $chuongtrinhtour->mota }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ngày</label>
                                            <input type="text" class="form-control" name="ngay"
                                                value="{{ $chuongtrinhtour->ngay }}">
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
