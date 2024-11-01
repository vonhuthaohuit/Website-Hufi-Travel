@extends('frontend.layouts.app')

@section('renderBody')
    <div class="container pt-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blogs</li>
            </ol>
        </nav>
    </div>

    <section id="wsus__blogs">
        <div class="container">
            @if (request()->has('search'))
                <h5></h5>
                <hr>
            @elseif (request()->has('category'))
                <h5></h5>
                <hr>
            @endif
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-xl-3">
                        <div class="wsus__single_blog wsus__single_blog_2">
                            <a class="wsus__blog_img" href="{{ route('blog.detail', $blog->slug) }}">
                                {{-- {{ route('blog-details', $blog->slug) }} --}}
                                <img src="{{ asset($blog->hinhanh) }}" alt="blog" class="img-fluid w-100">
                            </a>
                            <div class="wsus__blog_text">
                                <a class="blog_top red" href="#">{{ $blog->loaiblog->tenloai }}</a>
                                <div class="wsus__blog_text_center">
                                    <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->tieude }}</a>
                                    <p class="date">{{ date('d/m/Y', strtotime($blog->created_at)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

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
