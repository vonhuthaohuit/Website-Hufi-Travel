@extends('frontend.layouts.app')

@section('renderBody')
    @if ($tours->isEmpty())
        <section class="page-header">
            <div class="page-header__top">
                <div class="page-header-bg">
                </div>
                <div class="page-header-bg-overly"></div>
                <div class="container">
                    <div class="page-header__top-inner">
                        <h2>Không có tour nào</h2>
                    </div>
                </div>
            </div>
            <div class="page-header__bottom">
                <div class="container pt-4">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
    @else
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
                                                    <div class="popular-tours__stars">
                                                        <i class="fa fa-star"></i> 8.0 Superb
                                                    </div>
                                                    <h3 class="popular-tours__title"><a
                                                            href="{{ route('tour.detail', $item->slug) }}">{{ $item->tentour }}</a>
                                                    </h3>

                                                    <p class="popular-tours__rate">
                                                        <span>{{ number_format($item->giachitiettour) }}đ</span> / Một người
                                                    </p>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end pb-4">
                                <!-- Pagination here -->
                            </ul>
                        </nav>
                    </div>

                    <div class="col-md-3">
                        <div class="wsus__blog_search">
                            <h4>Tìm kiếm</h4>
                            <form action="" method="GET">
                                <input type="text" placeholder="Tìm kiếm..." name="search">
                                <button type="submit" class="common_btn"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
