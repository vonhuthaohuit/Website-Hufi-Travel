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
                <p class="mt-3">
                    ({{ $averageRating->total_reviews }}
                    lượt đánh giá)
                </p>
            </div>
        </div>

        <div class="tour-details__review-score__content">
            @foreach ($ratingsWithPercentage as $rating)
                <div class="tour-details__review-score__bar">
                    <div class="tour-details__review-score__bar-top">
                        <p>{{ $rating->diemdanhgia }} <i class="fa fa-star" style="color: #ffa801;"></i>
                            ({{ $rating->count }})
                        </p>
                    </div>
                    <div class="tour-details__review-score__bar-line">
                        <span class="wow slideInLeft animated" style="width: {{ $rating->percentage }}%;"></span>
                    </div>
                </div>
            @endforeach
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

                @if (Session::has('user'))
                    @php
                        $user = Session::get('user');
                        $currentAccountId = $user['mataikhoan'];
                    @endphp

                    @if ($item->khachhang->mataikhoan == $currentAccountId)
                        <div class="dropdown">
                            <a class="p-3" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <button class="dropdown-item btn-edit-comment" data-id="{{ $item->madanhgia }}">
                                        <i class="fa-solid fa-pen-to-square me-2" style="color: green;"></i> Sửa bình
                                        luận
                                    </button>
                                    <a class="dropdown-item" href="{{ route('comment.delete', $item->madanhgia) }}">
                                        <i class="fa-solid fa-trash-can me-2" style="color: red;"></i> Xóa bình luận
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                @else
                @endif
            </div>


            <div class="tour-details__review-form-stars">
                <div class="row">
                    <div class="col-md-4">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $item->diemdanhgia)
                                <i class="fa fa-star active"></i>
                            @else
                                <i class="fa-regular fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>

            <div class="tour-details__review-comment-content">
                <p>{{ $item->noidung }}</p>
            </div>
        </div>
        @include('frontend.tour.comment.edit-comment')
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
