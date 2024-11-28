@php
    $diemDens = \App\Models\DiemDuLich::layTatCaDiemDuLich();
    $noiKhoiHanhs = \App\Models\Tour::layTatCaNoiKhoiHanh();
    $loaiTours = \App\Models\LoaiTour::layTatCaLoaiTour();
    // Thời gian đi
    $durations = [
        '1' => '1 Ngày',
        '2-1' => '2 Ngày 1 Đêm',
        '3-2' => '3 Ngày 2 Đêm',
        '4-3' => '4 Ngày 3 Đêm',
        '5-4' => '5 Ngày 4 Đêm',
        '6-5' => '6 Ngày 5 Đêm',
        '7-6' => '7 Ngày 6 Đêm',
        '7' => 'Trên 7 Ngày',
    ];

    // Nơi khởi hành

@endphp


<div class="box-search-group">
    <div class="form-search-group">
        <div class="search-form">
            <button id="close-box-search">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path fill="#fff"
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </button>
            <form action="{{ route('tour.searchbox') }}" method="POST" class="" enctype="multipart/form-data">
                @csrf
                <h2 class="text-center mb-4">Tìm kiếm</h2>
                <div class="search-group-one">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="typetour">Loại tour</label>
                            <select name="typetour" class="form-select" id="typetour">
                                <option value="">Chọn loại tour</option>
                                @foreach ($loaiTours as $loaiTour)
                                    <option value="{{ $loaiTour->maloaitour }}">{{ $loaiTour->tenloai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="destination">Điểm đến</label>
                            <select name="destination" class="form-select" id="destination">
                                <option value="">Chọn điểm đến</option>
                                @foreach ($diemDens as $diemDen)
                                    <option value="{{ $diemDen->madiemdulich }}">{{ $diemDen->tendiemdulich }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="departure">Nơi khởi hành</label>
                            <select name="departure" class="form-select" id="departure">
                                <option value="">Chọn nơi khởi hành</option>
                                @foreach ($noiKhoiHanhs as $noiKhoiHanh)
                                    <option value="{{ $noiKhoiHanh->noikhoihanh }}">{{ $noiKhoiHanh->noikhoihanh }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="duration">Thời gian đi tour</label>
                            <select name="duration" class="form-select" id="duration">
                                <option value="">Chọn thời gian</option>
                                @foreach ($durations as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="date-start">Ngày bắt đầu</label>
                            <input type="date" name="date-start" class="form-control" id="date-start">
                        </div>
                        <div class="col-md-3">
                            <label for="date-end">Ngày kết thúc</label>
                            <input type="date" name="date-end" class="form-control" id="date-end">
                        </div>
                        <div class="col-md-3">
                            <input type="file" id="imageInput" name="image" accept="image/*">
                        </div>
                        <div class="col-md-3 align-self-end">
                            <button type="submit" id="btn-search" class="btn btn-search">Tìm kiếm</button>
                        </div>
                    </div>
                </div>

                <div class="row search-group-two">
                    <div class="col-md-4 mt-3 mb-3">
                        <label>Số sao tour</label>
                        <div class="d-flex flex-column">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="tour-star5">
                                <label class="form-check-label" for="tour-star5">⭐⭐⭐⭐⭐</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="tour-star4">
                                <label class="form-check-label" for="tour-star4">⭐⭐⭐⭐</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="tour-star3">
                                <label class="form-check-label" for="tour-star3">⭐⭐⭐</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="tour-star2">
                                <label class="form-check-label" for="tour-star2">⭐⭐</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="tour-star1">
                                <label class="form-check-label" for="tour-star1">⭐</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3 mb-3">
                        <label>Số sao khách sạn</label>
                        <div class="d-flex flex-column">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="hotel-star5">
                                <label class="form-check-label" for="hotel-star5">⭐⭐⭐⭐⭐</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="hotel-star4">
                                <label class="form-check-label" for="hotel-star4">⭐⭐⭐⭐</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="hotel-star3">
                                <label class="form-check-label" for="hotel-star3">⭐⭐⭐</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="hotel-star2">
                                <label class="form-check-label" for="hotel-star2">⭐⭐</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="hotel-star1">
                                <label class="form-check-label" for="hotel-star1">⭐</label>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 mt-3 mb-3">
                        <label>Giá</label>
                        <div class="range-slider d-flex align-items-center">
                            <span class="me-2">500.000 VND</span>
                            <input type="range" class="form-range" min="15000" max="60000" step="1000"
                                value="30000">
                            <span class="ms-2">60.000.000 VND</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@push('script')
    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            var startDate = document.getElementById("date-start").value;
            var endDate = document.getElementById("date-end").value;

            if (startDate && endDate && startDate > endDate) {
                alert("Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.");
                event.preventDefault();
            }
        });
    </script>
@endpush
