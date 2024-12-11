@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tài khoản</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa tài khoản</h4>
                            <div class="card-header-action">
                                <a href="{{ route('taikhoannv.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('taikhoannv.update', $taikhoan->mataikhoan) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $taikhoan->mataikhoan }}" name="mataikhoan">

                                <div class="form-group">
                                    <label>Tên tài khoản</label>
                                    <input type="text" class="form-control" name="tentaikhoan" value="{{ $taikhoan->tentaikhoan }}">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ $taikhoan->email }}">
                                </div>

                                <div class="form-group">
                                    <label>Trạng thái tài khoản</label>
                                    <select class="form-control" name="trangthai">
                                        <option value="Hoạt động" {{ $taikhoan->trangthai == 'Hoạt động' ? 'selected' : '' }}>Hoạt động</option>
                                        <option value="Khóa" {{ $taikhoan->trangthai == 'Khóa' ? 'selected' : '' }}>Khóa</option>
                                    </select>
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
