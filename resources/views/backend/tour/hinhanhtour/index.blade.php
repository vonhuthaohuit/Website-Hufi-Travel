@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hình ảnh tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $tour->tentour }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('hinhanhtour.create', ['tour_id' => $tour->matour]) }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i>
                                    Tạo mới</a>
                                <a id="create-new-btn" href="{{ route('tour.index') }}" class="btn btn-primary"
                                    class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
