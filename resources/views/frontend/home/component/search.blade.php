@push('style')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/smoothness/jquery-ui.css">
@endpush
@php
    $loaiTours = \App\Models\LoaiTour::layTatCaLoaiTour();
@endphp
<section class="tour-search">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="tour-search-box">
                    <form action="{{ route('tour.searchbox') }}" method="POST" class="tour-search-one">
                        @csrf
                        <div class="tour-search-one__inner">
                            <div class="tour-search-one__inputs">
                                <div class="tour-search-one__input-box">
                                    <label for="place">Điểm đến</label>
                                    <input type="text" placeholder="Nhập điểm đến" name="destination"
                                        id="destination">
                                </div>
                                <div class="tour-search-one__input-box">
                                    <label>Thời gian</label>
                                    <input type="text" placeholder="Nhập thời gian đi" name="duration"
                                        id="duration" class="hasDatepicker">
                                </div>
                                <div class="tour-search-one__input-box tour-search-one__input-box-last">
                                    <label for="typetour">Loại tour</label>
                                    <select name="typetour" class="form-select" id="typetour">
                                        <option value="">Chọn loại tour</option>
                                        @foreach ($loaiTours as $loaiTour)
                                            <option value="{{ $loaiTour->maloaitour }}">{{ $loaiTour->tenloai }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="tour-search-one__btn-wrap">
                                <button type="submit" class="thm-btn tour-search-one__btn">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
