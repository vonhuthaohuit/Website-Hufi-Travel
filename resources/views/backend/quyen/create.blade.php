@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 style="margin-left:50px">Quản lý quyền</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm quyền mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('quyen.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('quyen.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <div class="form-group col-md-6">
                                        <label>Tên quyền</label>
                                        <input type="text" class="form-control" name="tenquyen" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Mô tả</label>
                                        <textarea type="text" class="form-control" name="mota" required></textarea>
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
