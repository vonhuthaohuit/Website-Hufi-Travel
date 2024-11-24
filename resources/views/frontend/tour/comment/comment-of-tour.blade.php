@if (!@$averageRating->avg_rating)
@else
    <div class="tour-details__review-score">
        <div class="tour-details__review-score-ave">
            <div class="my-auto">
                <h3>{{ number_format(@$averageRating->avg_rating, 1) }}</h3>
                @php
                    $soSaoNguyen = floor($averageRating->avg_rating);
                    $soSaoDu = $averageRating->avg_rating - $soSaoNguyen;
                    $soSaoTrong = 5 - $soSaoNguyen - ($soSaoDu >= 0.5 ? 1 : 0);
                @endphp
                <p class="icon">
                    @if (!empty($averageRating->avg_rating))
                        @for ($i = 1; $i <= $soSaoNguyen; $i++)
                            <i class="fa fa-star"></i>
                        @endfor

                        @if ($soSaoDu >= 0.5)
                            <i class="fas fa-star-half-stroke"></i>
                        @endif

                        @for ($i = 1; $i <= $soSaoTrong; $i++)
                            <i class="fa-regular fa-star"></i>
                        @endfor
                    @else
                    @endif
                </p>
            </div>
        </div>
        <div class="tour-details__review-score__content">
            <div class="tour-details__review-score__bar">
                <div class="tour-details__review-score__bar-top">
                    <p>5 <i class="fa fa-star" style="color: #ffa801;"></i></p>
                </div>
                <div class="tour-details__review-score__bar-line">
                    <span class="wow slideInLeft animated" style="width: 50%;"></span>
                </div>
            </div>

            <div class="tour-details__review-score__bar">
                <div class="tour-details__review-score__bar-top">
                    <p>4 <i class="fa fa-star" style="color: #ffa801;"></i></p>
                </div>
                <div class="tour-details__review-score__bar-line">
                    <span class="wow slideInLeft animated" style="width: 87%;"></span>
                </div>
            </div>

            <div class="tour-details__review-score__bar">
                <div class="tour-details__review-score__bar-top">
                    <p>3 <i class="fa fa-star" style="color: #ffa801;"></i></p>
                </div>
                <div class="tour-details__review-score__bar-line">
                    <span class="wow slideInLeft animated" style="width: 77%;"></span>
                </div>
            </div>

            <div class="tour-details__review-score__bar">
                <div class="tour-details__review-score__bar-top">
                    <p>2 <i class="fa fa-star" style="color: #ffa801;"></i></p>
                </div>
                <div class="tour-details__review-score__bar-line">
                    <span class="wow slideInLeft animated" style="width: 69%;"></span>
                </div>
            </div>

            <div class="tour-details__review-score__bar">
                <div class="tour-details__review-score__bar-top">
                    <p>1 <i class="fa fa-star" style="color: #ffa801;"></i></p>
                </div>
                <div class="tour-details__review-score__bar-line">
                    <span class="wow slideInLeft animated" style="width: 40%;"></span>
                </div>
            </div>
        </div>

    </div>
@endif

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
                <p>{{ $item->noidung }}</p>
            </div>
        </div>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const progressBars = document.querySelectorAll('.tour-details__review-score__bar-line span');

        progressBars.forEach(bar => {
            const targetWidth = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => {
                bar.style.width = targetWidth;
            }, 100);
        });
    });
</script>
