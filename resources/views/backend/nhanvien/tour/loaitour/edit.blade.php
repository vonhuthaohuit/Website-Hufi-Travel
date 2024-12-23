@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tour Categoty</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa loại tour</h4>
                            <div class="card-header-action">
                                <a href="{{ route('loaitour.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('loaitour.update', $loaitour->maloaitour) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $loaitour->maloaitour }}" name="loaitourId">
                                <div class="form-group">
                                    <label>Tên loại tour</label>
                                    <input type="text" class="form-control" name="tenloai"
                                        value="{{ $loaitour->tenloai }}">
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
