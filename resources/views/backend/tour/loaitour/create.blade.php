@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Loại tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm loại tour mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('loaitour.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                        Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('loaitour.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên loại</label>
                                    <input type="text" class="form-control" name="tenloai" required>
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
