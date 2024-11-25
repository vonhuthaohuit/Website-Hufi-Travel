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
                                <a href="{{ route('khachsan_tour.index',['tour_id' => $tour->matour])}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('khachsan_tour.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Khách sạn</label>
                                            <select class="form-control" name="makhachsan">
                                                <option value="">Chọn khách sạn</option>
                                                @foreach ($khachsan as $khachsan)
                                                    <option value="{{ $khachsan->makhachsan }}">{{ $khachsan->tenkhachsan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Vị trí phòng\khu vực</label>
                                            <input type="text" class="form-control" name="vitriphong"
                                                value="{{ old('vitriphong') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sức chứa</label>
                                            <input type="number" class="form-control" name="succhua"
                                                value="{{ old('succhua') }}" required>
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
