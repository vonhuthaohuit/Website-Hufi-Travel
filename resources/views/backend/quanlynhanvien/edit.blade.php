@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Chỉnh sửa thông tin</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa thông tin nhân viên</h4>
                            <div class="card-header-action">
                                <a href="{{ route('blog.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('nhanvien.update', $nhanvien->manhanvien) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $nhanvien->manhanvien }}" name="blogId">

                                <div class="form-group">
                                    <label>Tên nhân viên</label>
                                    <input type="text" class="form-control" name="hoten"  readonly value="{{ $nhanvien->hoten }}">
                                </div>

                                <div class="form-group">
                                    <label>Bằng cấp</label>
                                    <input class="form-control" value="{{ $nhanvien->bangcap }}" name="bangcap">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phòng ban</label>
                                            <select class="form-control" name="maphongban">
                                                @foreach ($phongban as $phongbanItem)
                                                    <option value="{{ $phongbanItem->maphongban }}"
                                                        {{ $nhanvien->maphongban == $phongbanItem->maphongban ? 'selected' : '' }}>
                                                        {{ $phongbanItem->tenphongban }}
                                                    </option>
                                                @endforeach
                                            </select>
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

@push('scripts')

@endpush
