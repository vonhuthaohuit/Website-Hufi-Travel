@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 style="margin-left:50px">Quản lý nhóm quyền</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa nhóm quyền</h4>
                            <div class="card-header-action">
                                <a href="{{ route('quyen.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('nhomquyen.update', $nhomquyen->manhomquyen) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $nhomquyen->manhomquyen }}" name="manhomquyen">
                                <div>
                                    <div class="form-group col-md-6">
                                        <label>Tên quyền</label>
                                        <input type="text" class="form-control" value="{{ $nhomquyen->tennhomquyen }}" name="tennhomquyen" required>
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
