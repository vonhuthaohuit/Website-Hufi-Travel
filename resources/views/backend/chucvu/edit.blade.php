@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 style="margin-left:50px">Chức vụ</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa chức vụ</h4>
                            <div class="card-header-action">
                                <a href="{{ route('chucvu.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>Quay về
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('chucvu.update', $chucvu->machucvu) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $chucvu->machucvu }}" name="machucvu">
                                <div class="form-group">
                                    <label>Tên loại tour</label>
                                    <input type="text" class="form-control" name="tenchucvu"
                                        value="{{ $chucvu->tenchucvu }}">
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
