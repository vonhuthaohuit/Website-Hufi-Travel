@extends('frontend.layouts.app')

@push('style')
    <style>
        .wsus__description_area p {
            text-align: justify;
        }
    </style>
@endpush

@section('renderBody')
    <section class="page-header">
        <div class="page-header__bottom">
            <div class="container pt-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blog.blog-all') }}">Blogs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $blog->tieude }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section id="wsus__blog_details" class="pt-3 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-8">
                    <div class="wsus__main_blog">
                        <div class="wsus__main_blog_img">
                            <img src="{{ asset($blog->hinhanh) }}" alt="blog" class="img-fluid w-100">
                        </div>
                        <p class="wsus__main_blog_header mt-2">
                            <span><i class="fas fa-user-tie"></i> by {{ $blog->nhanvien->hoten }}</span>
                            <span><i class="fas fa-calendar-alt"></i>
                                {{ date('d/m/Y', strtotime($blog->created_at)) }}</span>
                        </p>
                        <div class="wsus__description_area">
                            <h1>{!! $blog->tieude !!}</h1>
                            {!! $blog->noidung !!}
                        </div>
                        <div class="wsus__share_blog">
                            <label>share:</label>
                            <ul>
                                <li>
                                    <a class="facebook"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>

                                <li>
                                    <a class="twitter"
                                        href="https://twitter.com/share?url={{ url()->current() }}&text={{ $blog->tieude }}">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>

                                <li>
                                    <a class="linkedin"
                                        href="https://www.linkedin.com/shareArticle?url={{ url()->current() }}&title={{ $blog->tieude }}">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- <div class="comment-group mb-4">
                            <h4>Bình luận</h4>
                            <div class="comment-box">
                                <div class="comment-avatar">
                                    <img src="{{ asset('frontend/images/icon/user.png') }}" alt="avatar">
                                </div>
                                <div class="comment-content">
                                    <textarea placeholder="Để lại bình luận của bạn"></textarea>
                                    <button type="submit">Gửi bình luận</button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-4">
                    @include('frontend.blog.component.blog-sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
