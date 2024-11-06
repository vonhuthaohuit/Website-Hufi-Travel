@foreach ($blogs as $blog)
    <div class="col-xl-4 mb-4">
        <div class="wsus__single_blog wsus__single_blog_2">
            <a class="wsus__blog_img" href="{{ route('blog.detail', $blog->slug) }}">
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
