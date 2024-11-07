@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Blog</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa blog</h4>
                            <div class="card-header-action">
                                <a href="{{ route('blog.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('blog.update', $blog->mablogtour) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $blog->mablogtour }}" name="blogId">

                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" class="form-control" name="tieude" value="{{ $blog->tieude }}">
                                </div>

                                <div class="form-group">
                                    <label>Nội dung blog</label>
                                    <textarea class="form-control summernote" name="noidung">{{ $blog->noidung }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Hình ảnh đại diện blog</label>
                                            <input type="file" class="form-control" name="hinhanh">
                                            <img src="{{ asset($blog->hinhanh) }}" width="100" alt="Current Image">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Loại blog</label>
                                            <select class="form-control" name="maloaiblog">
                                                @foreach ($loaiblog as $loaiblogItem)
                                                    <option value="{{ $loaiblogItem->maloaiblog }}"
                                                        {{ $blog->maloaiblog == $loaiblogItem->maloaiblog ? 'selected' : '' }}>
                                                        {{ $loaiblogItem->tenloaiblog }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select class="form-control" name="trangthaiblog">
                                                <option value="0" {{ $blog->trangthaiblog == 0 ? 'selected' : '' }}>Không
                                                    hoạt động
                                                </option>
                                                <option value="1" {{ $blog->trangthaiblog == 1 ? 'selected' : '' }}>Hoạt
                                                    động
                                                </option>
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

{{-- @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush --}}
