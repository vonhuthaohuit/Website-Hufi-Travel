<div class="wsus__blog_search">
    <h4>Tìm kiếm</h4>
    <form action="{{ route('tour.search') }}" method="GET">
        <input type="text" placeholder="Tìm kiếm..." name="search_query" required>
        <button type="submit" class="common_btn"><i class="fas fa-search"></i></button>
    </form>
</div>

<div class="wsus__blog_category">
    <h4>Loại tour</h4>
    <ul>
        @foreach ($tourCategories as $category)
            <li>
                <a href="{{ route('tour.search', ['category' => $category->tenloai]) }}">{{ $category->tenloai }}</a>
                {{-- {{ route('blog', ['category' => $category->slug]) }} --}}
            </li>
        @endforeach
    </ul>
</div>
