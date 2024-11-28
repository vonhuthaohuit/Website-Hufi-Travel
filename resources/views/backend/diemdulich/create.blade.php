@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Điểm du lịch</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm điểm du lịch mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('diemdulich.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                        Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('diemdulich.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên điểm du lịch</label>
                                    <input type="text" class="form-control" name="tendiem" required>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea type="text" class="form-control" name="mota" required> </textarea>
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
