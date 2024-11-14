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

                        @if (count($tours) === 0)
                            <div class="row">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h3>Rất tiếc không tìm thấy tour nào!</h3>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h3 class="mt-3 mb-5" style="color: #333;">Tìm thấy <b>{{ $count }}</b> kết quả hiển thị
                                cho
                                từ khóa <b>"{{ $query }}"</b></h3>
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
                                                    <div class="popular-tours__stars">
                                                        <i class="fa fa-star"></i> 8.0 Superb
                                                    </div>
                                                    <h3 class="popular-tours__title"><a
                                                            href="{{ route('tour.detail', $item->slug) }}">{{ $item->tentour }}</a>
                                                    </h3>

                                                    <p class="popular-tours__rate">
                                                        <span>{{ number_format($item->giatour) }}đ</span> / Một người
                                                    </p>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end pb-4 d-flex justify-content-between">
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
@endsection
