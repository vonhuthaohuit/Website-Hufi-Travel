<div class="box-search-group">
    <div class="form-search-group">
        <div class="search-form">
            <button id="close-box-search">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path fill="#fff"
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </button>
            <form>
                <h2 class="text-center mb-4">Tìm kiếm</h2>
                <div class="search-group-one">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label for="destination">Điểm đến</label>
                            <select class="form-select" id="destination">
                                <option>Hà Nội</option>
                                <option>Đà Nẵng</option>
                                <option>Phú Quốc</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="departure">Nơi khởi hành</label>
                            <select class="form-select" id="departure">
                                <option>TP. HCM</option>
                                <option>Hà Nội</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="date">Ngày đi</label>
                            <input type="date" class="form-control" id="date">
                        </div>
                        <div class="col-md-2">
                            <label for="duration">Khoảng thời gian</label>
                            <select class="form-select" id="duration">
                                <option>7 ngày</option>
                                <option>10 ngày</option>
                                <option>14 ngày</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="guests">Số người</label>
                            <select class="form-select" id="guests">
                                <option>2 người lớn</option>
                                <option>2 người lớn, 1 trẻ em</option>
                                <option>3 người lớn</option>
                            </select>
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button type="button" class="btn btn-search">Tìm kiếm</button>
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
