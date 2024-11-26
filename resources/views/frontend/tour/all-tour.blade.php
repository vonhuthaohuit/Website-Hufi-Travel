@extends('frontend.layouts.app')

@section('renderBody')
    <section class="page-header">
        <div class="page-header__top">
            <div class="page-header-bg">
            </div>
            <div class="page-header-bg-overly"></div>
            <div class="container">
                <div class="page-header__top-inner">
                    <h2>Danh sách tour</h2>
                </div>
            </div>
        </div>
        <div class="page-header__bottom">
            <div class="container pt-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách tour</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="list-tour-section mt-4 mb-4">
        <div class="container-xl">
            @if (request()->has('search'))
                <h5></h5>
                <hr>
            @elseif (request()->has('category'))
                <h5></h5>
                <hr>
            @endif
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        @foreach ($tours as $item)
                            <div class="owl-item col-6 col-lg-4 mb-4">
                                <div class="popular-tours__single">
                                    <a href="{{ route('tour.detail', $item->slug) }}">
                                        <div class="popular-tours__img">
                                            <img src="{{ asset($item->hinhdaidien) }}" alt="{{ $item->tentour }}">
                                            <div class="popular-tours__icon">
                                                <a href="{{ route('tour.detail', $item->slug) }}">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="popular-tours__content">
                                            <a href="{{ route('tour.detail', $item->slug) }}">
                                                {{-- <div class="popular-tours__stars">
                                                    <i class="fa fa-star"></i> 8.0 Superb
                                                </div> --}}



                                                <h3 class="popular-tours__title"><a
                                                        href="{{ route('tour.detail', $item->slug) }}">{{ $item->tentour }}</a>
                                                </h3>

                                                @php
                                                    $soSaoNguyen = floor($item->avg_rating); // Số sao đầy
                                                    $soSaoDu = $item->avg_rating - $soSaoNguyen; // Phần dư
                                                    $soSaoTrong = 5 - $soSaoNguyen - ($soSaoDu >= 0.5 ? 1 : 0); // Số sao trống
                                                @endphp

                                                <div class="popular-tours__stars mb-2">
                                                    @if (!empty($item->avg_rating))
                                                        @for ($i = 1; $i <= $soSaoNguyen; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor

                                                        @if ($soSaoDu >= 0.5)
                                                            <i class="fa-solid fa-star-half-stroke"></i>
                                                        @endif

                                                        @for ($i = 1; $i <= $soSaoTrong; $i++)
                                                            <i class="fa-regular fa-star"></i>
                                                        @endfor
                                                    @else
                                                    @endif
                                                </div>

                                                @if (empty($item->makhuyenmai))
                                                    <p class="popular-tours__rate">
                                                        <span>{{ number_format($item->giatour) }}đ</span> / Một người
                                                    </p>
                                                @else
                                                    <p class="popular-tours__rate">
                                                        <span><del
                                                                class="original-price">{{ number_format($item->giatour) }}đ</del>
                                                            {{ number_format($item->giatourgiam) }}đ</span> / Một người
                                                    </p>
                                                @endif
                                            </a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end pb-4">
                            {{ $tours->links('pagination::bootstrap-5') }}
                        </ul>
                    </nav>
                </div>

                <div class="col-md-3">
                    @include('frontend.tour.component.sidebar-tour')
                </div>
            </div>
        </div>
    </section>

    @push('style')
        <style>
            .text-muted {
                display: none;
            }
        </style>
    @endpush
@endsection
