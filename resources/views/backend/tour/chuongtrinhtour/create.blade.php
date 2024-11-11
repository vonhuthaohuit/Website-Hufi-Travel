@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm chi tiết mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('chuongtrinhtour.index',['tour_id' => $tour->matour])}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('chuongtrinhtour.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tiêu đề chương trình tour</label>
                                    <input type="text" class="form-control" name="tieude" value="{{ old('tieude') }}">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả tour</label>
                                    <textarea class="form-control summernote" name="mota">{{ old('mota') }}</textarea>
                                </div>

                                <input type="hidden" name="tour_id" value="{{ $tour->matour }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ngày </label>
                                            <input type="text" class="form-control" name="ngay"
                                                value="{{ old('ngay') }}">
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
