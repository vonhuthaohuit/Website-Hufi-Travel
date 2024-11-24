<div class="tour-details__review-score">
    <div class="tour-details__review-score-ave">
        <div class="my-auto">
            <h3>7.0</h3>
            <p><i class="fa fa-star"></i> Super</p>
        </div>
    </div>
    <div class="tour-details__review-score__content">
        <!--Tour Details Review Score Bar-->
        <div class="tour-details__review-score__bar">
            <div class="tour-details__review-score__bar-top">
                <h3>Services</h3>
                <p>50%</p>

            </div>
            <div class="tour-details__review-score__bar-line">
                <span class="wow slideInLeft animated" data-wow-duration="1500ms"
                    style="width: 50%; visibility: visible; animation-duration: 1500ms; animation-name: slideInLeft;"></span>
            </div>
        </div>
        <!--Tour Details Review Score Bar-->
        <div class="tour-details__review-score__bar">
            <div class="tour-details__review-score__bar-top">
                <h3>Locations</h3>
                <p>87%</p>

            </div>
            <div class="tour-details__review-score__bar-line">
                <span class="wow slideInLeft animated" data-wow-duration="1500ms"
                    style="width: 87%; visibility: visible; animation-duration: 1500ms; animation-name: slideInLeft;"></span>
            </div>
        </div>
        <!--Tour Details Review Score Bar-->
        <div class="tour-details__review-score__bar">
            <div class="tour-details__review-score__bar-top">
                <h3>Amenities</h3>
                <p>77%</p>

            </div>
            <div class="tour-details__review-score__bar-line">
                <span class="wow slideInLeft animated" data-wow-duration="1500ms"
                    style="width: 77%; visibility: visible; animation-duration: 1500ms; animation-name: slideInLeft;"></span>
            </div>
        </div>
        <!--Tour Details Review Score Bar-->
        <div class="tour-details__review-score__bar">
            <div class="tour-details__review-score__bar-top">
                <h3>Prices</h3>
                <p>69%</p>

            </div>
            <div class="tour-details__review-score__bar-line">
                <span class="wow slideInLeft animated" data-wow-duration="1500ms"
                    style="width: 69%; visibility: visible; animation-duration: 1500ms; animation-name: slideInLeft;"></span>
            </div>
        </div>
        <!--Tour Details Review Score Bar-->
        <div class="tour-details__review-score__bar">
            <div class="tour-details__review-score__bar-top">
                <h3>Food</h3>
                <p>40%</p>

            </div>
            <div class="tour-details__review-score__bar-line">
                <span class="wow slideInLeft animated" data-wow-duration="1500ms"
                    style="width: 40%; visibility: visible; animation-duration: 1500ms; animation-name: slideInLeft;"></span>
            </div>
        </div>
    </div>
</div>

<div class="tour-details__review-comment">
    @foreach ($commentOfTour as $item)
        <div class="tour-details__review-comment-single">
            <div class="d-flex justify-content-between">
                <div class="tour-details__review-comment-top mb-3">
                    <div class="tour-details__review-comment-top-img">
                        <img src="{{ asset('frontend/images/icon/user.png') }}" alt="">
                    </div>
                    <div class="tour-details__review-comment-top-content">
                        <h3>{{ $item->hoten }}</h3>
                        <p>{{ date('d/m/Y', strtotime($item->created_at)) }}</p>
                    </div>
                </div>

                <i class="fa-solid fa-ellipsis-vertical"></i>
            </div>


            <div class="tour-details__review-form-stars">
                <div class="row">
                    <div class="col-md-4">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $item->diemdanhgia)
                                <i class="fa fa-star active"></i>
                            @else
                                <i class="fa fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>


            <div class="tour-details__review-comment-content">
                {{-- <h3>Fun Was To Discover This</h3> --}}
                <p>{{ $item->noidung }}</p>
            </div>
        </div>
    @endforeach
</div>
