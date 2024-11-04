@extends('frontend.layouts.app')

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

                        <div class="comment-group mb-4">
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
                        </div>
                        {{-- @if (count($recentBlogs) != 0)
                            <div class="wsus__related_post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <h5>Recent posts</h5>
                                    </div>
                                </div>
                                <div class="row blog_det_slider">
                                    @foreach ($recentBlogs as $blogItem)
                                        <div class="col-xl-3">
                                            <div class="wsus__single_blog wsus__single_blog_2">
                                                <a class="wsus__blog_img"
                                                    href="{{ route('blog-detail', $blogItem->slug) }}">
                                                    <img src="{{ asset($blogItem->image) }}" alt="blog"
                                                        class="img-fluid w-100">
                                                </a>
                                                <div class="wsus__blog_text">
                                                    <a class="blog_top red"
                                                        href="#">{{ $blogItem->category->name }}</a>
                                                    <div class="wsus__blog_text_center">
                                                        <a
                                                            href="{{ route('blog-detail', $blogItem->slug) }}">{{ $blogItem->title }}</a>
                                                        <p class="date">
                                                            {{ date('M D Y', strtotime($blogItem->created_at)) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endif --}}
                        {{-- <div class="wsus__comment_area">
                            <h4>comment <span>{{ count($comments) }}</span></h4>
                            @foreach ($comments as $comment)
                                <div class="wsus__main_comment">
                                    <div class="wsus__comment_img">
                                        <img style="width: 80px;height: 80px;object-fit: contain;"
                                            src="{{ asset($comment->user->image) }}" alt="user"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__comment_text replay">
                                        <h6>{{ $comment->user->name }}
                                            <span>{{ date('d M Y', strtotime($comment->created_at)) }}</span>
                                        </h6>
                                        <p>{{ $comment->comment }}</p>

                                    </div>
                                </div>
                            @endforeach
                            @if (count($comments) === 0)
                                <i>Be a first one to comment! </i>
                            @endif

                            <div id="pagination">
                                <div class="mt-5">
                                    @if ($comments->hasPages())
                                        {{ $comments->withQueryString()->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="wsus__post_comment">
                            <h4>post a comment</h4>
                            @if (auth()->check())
                                <form action="{{ route('user.blog-comment') }}" method="POST">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-12">
                                            <div class="wsus__single_com">
                                                <textarea rows="5" placeholder="Your Comment" name="comment"></textarea>
                                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="common_btn" type="submit">post comment</button>
                                </form>
                            @else
                                <p>Please login to comment on post!</p>
                                <a class="common_btn" href="{{ route('login') }}">Login</a>
                            @endif
                        </div> --}}
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-4">
                    <div class="wsus__blog_sidebar" id="sticky_sidebar">
                        <div class="wsus__blog_search">
                            <h4>Tìm kiếm</h4>
                            <form action="" method="GET">
                                <input type="text" placeholder="Tìm kiếm..." name="search">
                                <button type="submit" class="common_btn"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <div class="wsus__blog_category">
                            <h4>Loại blog</h4>
                            <ul>
                                @foreach ($blogcategories as $category)
                                    <li>
                                        <a href="">{{ $category->tenloaiblog }}</a>
                                        {{-- {{ route('blog', ['category' => $category->slug]) }} --}}
                                    </li>
                                @endforeach
                            </ul>
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
        </div>
    </section>
@endsection
