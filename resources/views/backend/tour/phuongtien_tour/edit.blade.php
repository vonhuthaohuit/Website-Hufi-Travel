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
                                <a href="{{ route('phuongtien_tour.index',['tour_id'=>$phuongtien_tour->matour]) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('phuongtien_tour.update', $phuongtien_tour->matour) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $phuongtien_tour->matour }}" name="tour_id">
                                <input type="hidden" value="{{ $phuongtien_tour->maphuongtien }}" name="maphuongtien_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phương tiện</label>
                                            <p>{{ $phuongtien_tour->phuongtien->tenphuongtien }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Số lượng hành khách</label>
                                            <input type="text" class="form-control" name="soluonghanhkhach"
                                                value="{{ $phuongtien_tour->soluonghanhkhach }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ghi chú</label>
                                            <textarea type="text" class="form-control" name="ghichu"
                                                value="" required>{{ $phuongtien_tour->ghichu }}</textarea>
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
