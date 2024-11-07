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
                            <h4>Thêm phương tiện mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('phuongtien_tour.index',['tour_id' => $tour->matour])}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('phuongtien_tour.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phương tiện</label>
                                            <select class="form-control" name="maphuongtien">
                                                <option value="">Chọn phương tiện</option>
                                                @foreach ($phuongtien as $phuongtien)
                                                    <option value="{{ $phuongtien->maphuongtien }}">{{ $phuongtien->tenphuongtien }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Số lượng hành khách</label>
                                            <input type="text" class="form-control" name="soluonghanhkhach"
                                                value="{{ old('soluonghanhkhach') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ghi chú</label>
                                            <textarea type="text" class="form-control" name="ghichu"
                                                value="{{ old('ghichu') }}" required></textarea>
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
