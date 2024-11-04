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
                            <h4>Thêm blog mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('blog.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" class="form-control" name="tieude" required>
                                </div>

                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea id="summernote" class="form-control summernote" name="noidung">{{ old('noidung') }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Hình ảnh đại diện blog</label>
                                            <input type="file" class="form-control" name="hinhanh">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Loại blog</label>
                                            <select class="form-control" name="maloaiblog">
                                                <option value="">Chọn loại tour</option>
                                                @foreach ($loaiblog as $loaiblogItem)
                                                    <option value="{{ $loaiblogItem->maloaiblog }}">{{ $loaiblogItem->tenloaiblog }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select class="form-control" name="trangthaiblog">
                                                <option value="">Chọn tình trạng</option>
                                                <option value="1">Kích hoạt</option>
                                                <option value="0">Không kích hoạt</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Tạo mới</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Any additional JavaScript can go here
        });
    </script>
@endpush
