@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 style="margin-left:50px">Quản lý quyền/h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa quyền</h4>
                            <div class="card-header-action">
                                <a href="{{ route('quyen.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('quyen.update', $quyen->maquyen) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $quyen->maquyen }}" name="maquyen">
                                <div>
                                    <div class="form-group col-md-6">
                                        <label>Tên quyền</label>
                                        <input type="text" class="form-control" name="tenquyen" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Mô tả</label>
                                        <input type="text" class="form-control" name="mota" required>
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
