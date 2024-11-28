@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Điểm du lịch</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa loại tour</h4>
                            <div class="card-header-action">
                                <a href="{{ route('diemdulich.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>Quay về
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('diemdulich.update', $diemdulich->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $diemdulich->id }}" name="diemdulich_id">
                                <div class="form-group">
                                    <label>Tên điểm du lịch</label>
                                    <input type="text" class="form-control" name="tendiem" required
                                        value="{{ $diemdulich->tendiem }}">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <input type="text" class="form-control" name="mota"
                                        value="{{ $diemdulich->mota }}">
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
