@extends('frontend.layouts.app')

@section('renderBody')
    <section class="page-header">
        <div class="page-header__top">
            <div class="page-header-bg">
            </div>
            <div class="page-header-bg-overly"></div>
            <div class="container">
                <div class="page-header__top-inner">
                    <h2>Blog</h2>
                </div>
            </div>
        </div>
        <div class="page-header__bottom">
            <div class="container pt-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section id="wsus__blogs">
        <div class="container pt-4">
            @if (request()->has('search'))
                <h5></h5>
                <hr>
            @elseif (request()->has('category'))
                <h5></h5>
                <hr>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-xl-4 mb-4">
                                <div class="wsus__single_blog wsus__single_blog_2">
                                    <a class="wsus__blog_img" href="{{ route('blog.detail', $blog->slug) }}">
                                        {{-- {{ route('blog-details', $blog->slug) }} --}}
                                        <img src="{{ asset($blog->hinhanh) }}" alt="blog" class="img-fluid w-100">
                                    </a>
                                    <div class="wsus__blog_text">
                                        <a class="blog_top red" href="#">{{ $blog->loaiblog->tenloaiblog }}</a>
                                        <div class="wsus__blog_text_center">
                                            <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->tieude }}</a>
                                            <p class="date">{{ date('d/m/Y', strtotime($blog->created_at)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="wsus__blog_sidebar" id="sticky_sidebar">
                        <div class="wsus__blog_search">
                            <h4>Tìm kiếm</h4>
                            <form action="" method="GET">
                                <input type="text" placeholder="Tìm kiếm..." name="search">
                                <button type="submit" class="common_btn"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <div class="wsus__blog_post">
                            <h4>Các bài blog khác</h4>
                            @foreach ($moreBlogs as $blog)
                                <div class="wsus__blog_post_single">
                                    <a href="{{ route('blog.detail', $blog->slug) }}" class="wsus__blog_post_img">
                                        <img style="height: 71px;" src="{{ asset('frontend/images/destination-1-3.png') }}"
                                            alt="blog" class="imgofluid w-100">
                                    </a>
                                    <div class="wsus__blog_post_text">
                                        <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->tieude }}</a>
                                        <p> <span>{{ date('d/m/Y', strtotime($blog->created_at)) }} </span></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @if (count($blogs) === 0)
                <div class="row">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3>Sorry No Blog Found!</h3>
                        </div>
                    </div>
                </div>
            @endif
            <div id="pagination">
                <div class="mt-5">
                    @if ($blogs->hasPages())
                        {{ $blogs->withQueryString()->links() }}
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
