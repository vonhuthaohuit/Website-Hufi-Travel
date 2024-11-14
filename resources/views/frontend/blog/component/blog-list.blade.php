@foreach ($blogs as $blog)
    <div class="col-xl-4 mb-4">
        <div class="wsus__single_blog wsus__single_blog_2">
            <a class="wsus__blog_img" href="{{ route('blog.detail', $blog->slug) }}">
                <img src="{{ asset($blog->hinhanh) }}" alt="blog" class="img-fluid w-100">
            </a>
            <div class="wsus__blog_text">
                {{-- <a class="blog_top red" href="#">{{ $blog->loaiblog->tenloaiblog }}</a> --}}
                <div class="wsus__blog_text_center">
                    {{-- <p class="date">{{ date('d/m/Y', strtotime($blog->created_at)) }}</p> --}}
                    <ul class="list-unstyled news-one__meta">
                        <li><a href="news-details.html"><i
                                    class="far fa-user-circle"></i>{{ $blog->nhanvien->hoten }}</a></li>
                        <li><a href="news-details.html"><i
                                    class="fas fa-calendar-alt"></i>{{ date('d/m/Y', strtotime($blog->created_at)) }}</a>
                        </li>
                    </ul>
                    <a href="{{ route('blog.detail', $blog->slug) }}" class="mt-2">{{ $blog->tieude }}</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
