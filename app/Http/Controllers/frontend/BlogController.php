<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogTour;
use App\Models\LoaiBlog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs = BlogTour::with('loaiblog')->where('trangthaiblog', 1)->orderBy('mablogtour', 'DESC')->paginate(12);
        $moreBlogs = BlogTour::where('trangthaiblog', 1)
            ->orderBy('mablogtour', 'DESC')->take(5)->get();

        $recentBlogs = BlogTour::where('trangthaiblog', 1)
            ->orderBy('mablogtour', 'DESC')->take(12)->get();
        $blogcategories = LoaiBlog::all();
        return view('frontend.blog.blog', compact('blogs', 'moreBlogs', 'recentBlogs', 'blogcategories'));
    }
    public function blogDetail(string $slug)
    {
        $blog = BlogTour::where('slug', $slug)
            ->where('trangthaiblog', 1)
            ->firstOrFail();

        $moreBlogs = BlogTour::where('slug', '!=', $slug)
            ->where('trangthaiblog', 1)
            ->orderBy('mablogtour', 'DESC')->take(5)->get();

        $recentBlogs = BlogTour::where('slug', '!=', $slug)
            ->where('trangthaiblog', 1)
            ->where('maloaiblog', $blog->maloaiblog)
            ->orderBy('mablogtour', 'DESC')->take(12)->get();

        $blogcategories = LoaiBlog::all();
        return view('frontend.blog.blog-detail', compact('blog', 'moreBlogs', 'recentBlogs', 'blogcategories'));
    }

    public function search(Request $request)
    {
        if ($request->has('search_query')) {
            $blogs = BlogTour::with('loaiblog')
                ->where('tieude', 'like', '%' . $request->search_query . '%')
                ->where('trangthaiblog', 1)
                ->orderBy('mablogtour', 'DESC')
                ->paginate(12);

            $moreBlogs = BlogTour::where('trangthaiblog', 1)
                ->orderBy('mablogtour', 'DESC')->take(5)->get();

            $blogcategories = LoaiBlog::take(5)->get();

            $query = $request->search_query;
        } elseif ($request->has('category')) {
            $category = LoaiBlog::where('tenloaiblog', $request->category)->firstOrFail();

            $blogs = BlogTour::with('loaiblog')->where('maloaiblog', $category->maloaiblog)
                ->where('trangthaiblog', 1)->orderBy('mablogtour', 'DESC')
                ->paginate(12);

            $moreBlogs = BlogTour::where('trangthaiblog', 1)
                ->orderBy('mablogtour', 'DESC')->take(5)->get();
            $blogcategories = LoaiBlog::take(5)->get();
            $query = $request->category;
        } else {
            // $blogs = BlogTour::with('loaiblog')->where('trangthaiblog', 1)->orderBy('mablogtour', 'DESC')->paginate(3);
        }

        $count = $blogs->count();

        return view('frontend.blog.blogSearch', compact('blogs', 'moreBlogs', 'blogcategories', 'query', 'count'));
    }
}
