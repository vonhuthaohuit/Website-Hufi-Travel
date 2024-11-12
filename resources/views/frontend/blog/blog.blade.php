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
                <div class="col-lg-9">
                    <div class="row">
                        @if (count($blogs) === 0)
                            <div class="row">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h3>Sorry No Blog Found!</h3>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @include('frontend.blog.component.blog-list')

                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end pb-4">
                                {{ $blogs->links('pagination::bootstrap-5') }}
                            </ul>
                        </nav>

                    </div>

                </div>
                <div class="col-lg-3">
                    @include('frontend.blog.component.blog-sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
