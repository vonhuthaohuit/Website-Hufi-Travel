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

            $blogcategories = LoaiBlog::all();
        } elseif ($request->has('category')) {
            $category = LoaiBlog::where('slug', $request->category)->firstOrFail();

            $blogs = BlogTour::with('loaitour')->where('maloaitour', $category->maloaitour)
                ->where('trangthaitour', 1)->orderBy('mablogtour', 'DESC')
                ->paginate(12);
        } else {
            $blogs = BlogTour::with('loaiblog')->where('trangthaiblog', 1)->orderBy('mablogtour', 'DESC')->paginate(3);
        }

        $query = $request->search_query;

        $count = $blogs->count();

        return view('frontend.blog.blogSearch', compact('blogs', 'moreBlogs', 'blogcategories', 'query', 'count'));
    }
}
