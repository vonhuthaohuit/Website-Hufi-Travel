@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 style="margin-left:50px">Phòng ban</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm phòng ban mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('phongban.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('phongban.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên phòng ban</label>
                                    <input type="text" class="form-control" name="tenphongban" required>
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
