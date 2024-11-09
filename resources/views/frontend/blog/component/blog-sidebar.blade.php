<div class="wsus__blog_sidebar" id="sticky_sidebar">
    <div class="wsus__blog_search">
        <h4>Tìm kiếm</h4>
        <form action="{{ route('blog.search') }}" method="GET">
            <input type="text" placeholder="Tìm kiếm..." name="search_query" required>
            <button type="submit" class="common_btn"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div class="wsus__blog_category">
        <h4>Loại blog</h4>
        <ul>
            @foreach ($blogcategories as $category)
                <li>

                    <a href="{{route('blog.search', ['category' => $category->tenloaiblog])}}">{{ $category->tenloaiblog }}</a>
                    {{-- {{ route('blog', ['category' => $category->slug]) }} --}}
                </li>
            @endforeach
        </ul>
    </div>

    @if (count($moreBlogs) === 0)
    @else
        <div class="wsus__blog_post">
            <h4>Các bài blog khác</h4>
            @foreach ($moreBlogs as $blog)
                <div class="wsus__blog_post_single">
                    <a href="{{ route('blog.detail', $blog->slug) }}" class="wsus__blog_post_img">
                        <img style="height: 71px;" src="{{ asset($blog->hinhanh) }}" alt="blog"
                            class="imgofluid w-100">
                    </a>
                    <div class="wsus__blog_post_text">
                        <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->tieude }}</a>
                        <p> <span>{{ date('d/m/Y', strtotime($blog->created_at)) }} </span></p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif


</div>
