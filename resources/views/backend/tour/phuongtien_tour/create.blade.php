@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Phương tiện của tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm phương tiện mới</h4>
                            <div class="card-header-action">
                                <a href="{{ route('phuongtien_tour.index',['tour_id' => $tour->matour])}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('phuongtien_tour.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phương tiện</label>
                                            <select class="form-control" name="maphuongtien" id="maphuongtien">
                                                <option value="">Chọn phương tiện</option>
                                                @foreach ($phuongtien as $pt)
                                                    <option value="{{ $pt->maphuongtien }}" data-socho="{{ $pt->sochongoi }}">{{ $pt->tenphuongtien }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Số lượng hành khách</label>
                                            <input type="text" class="form-control" id="sochongoi" name="soluonghanhkhach" required>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ghi chú</label>
                                            <textarea type="text" class="form-control" name="ghichu"
                                                value="{{ old('ghichu') }}" ></textarea>
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
      <script>
        $(document).ready(function () {
            $('#maphuongtien').on('change', function () {
                // Lấy số chỗ ngồi từ data attribute của option được chọn
                var selectedOption = $(this).find('option:selected');
                var soChoNgoi = selectedOption.data('socho');

                // Hiển thị số chỗ ngồi vào input
                $('#sochongoi').val(soChoNgoi || ''); // Nếu không có thì để trống
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            let maxSeats = 0; // Số chỗ tối đa của phương tiện được chọn

            // Khi chọn phương tiện, cập nhật số chỗ ngồi tối đa
            $('#maphuongtien').on('change', function () {
                const selectedOption = $(this).find('option:selected');
                maxSeats = selectedOption.data('socho') || 0; // Nếu không có, mặc định là 0
                $('#sochongoi').val(maxSeats); // Điền số chỗ vào input
            });

            // Khi thay đổi giá trị trong ô input, kiểm tra số lượng
            $('#sochongoi').on('input', function () {
                const inputSeats = parseInt($(this).val(), 10) || 0; // Chuyển giá trị sang số nguyên
                if (inputSeats > maxSeats) {
                   toastr.error('Xe không đủ chỗ ngồi');

                }
            });
        });
    </script>
@endpush
