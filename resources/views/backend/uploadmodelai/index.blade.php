@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Model AI</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning">
                        <strong>Chú ý!</strong> Đây là nơi update lại model AI để hỗ trợ cho việc tìm kiếm bằng hình ảnh.
                        Chỉ những người có kinh nghiệm và được hướng dẫn rõ ràng về phần này mới được sử dụng.
                        Không được tự ý sử dụng khi chưa có sự giám sát từ bộ phận kỹ thuật.
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center mt-4">
                        <a href="{{ route('upload.model.ai') }}" class="btn btn-lg btn-success">
                            <i class="fas fa-upload"></i> Upload Model AI
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mt-4">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
    </section>
@endsection
