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
                                <a href="{{ route('chitiettour.index',['tour_id' => $tour->matour])}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('chitiettour.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="form-group">
                                    <label>Tiêu đề chương trình tour</label>
                                    <input type="text" class="form-control" name="tieude" value="{{ old('tieude') }}">
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Thời gian bắt đầu</label>
                                            <input type="date" class="form-control" name="ngaybatdau"
                                                value="{{ old('ngaybatdau') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Giá</label>
                                            <input type="text" class="form-control" name="gia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Điểm du lịch</label>
                                            <select class="form-control" name="madiemdulich">
                                                <option value="">Chọn điểm du lịch</option>
                                                @foreach ($diemdulich as $diemdulich_item)
                                                    <option value="{{ $diemdulich_item->madiemdulich }}">{{ $diemdulich_item->tendiemdulich }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="tour_id" value="{{ $tour->matour }}">
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
