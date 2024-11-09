@push('style')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/smoothness/jquery-ui.css">
@endpush

<section class="tour-search">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="tour-search-box">
                    <form class="tour-search-one" action="">
                        <div class="tour-search-one__inner">
                            <div class="tour-search-one__inputs">
                                <div class="tour-search-one__input-box">
                                    <label for="place">Điểm đến</label>
                                    <input type="text" placeholder="Nhập điểm đến" name="place" id="place">
                                </div>
                                <div class="tour-search-one__input-box">
                                    <label>Thời gian</label>
                                    <input type="text" placeholder="Nhập thời gian đi" name="when" id="datepicker"
                                        class="hasDatepicker">
                                </div>
                                <div class="tour-search-one__input-box tour-search-one__input-box-last">
                                    <label for="type">Loại tour</label>
                                    <div class="dropdown">
                                        <button class="btn btn-tour-type dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Chọn loại tour
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="#"
                                                    data-value="Adventure">Adventure</a></li>
                                            <li><a class="dropdown-item" href="#"
                                                    data-value="Wildlife">Wildlife</a></li>
                                            <li><a class="dropdown-item" href="#"
                                                    data-value="Sightseeing">Sightseeing</a></li>
                                        </ul>
                                    </div>
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
