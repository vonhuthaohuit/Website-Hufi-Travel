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
        $blogs = BlogTour::with('loaiblog')->where('trangthai', 1)->orderBy('id', 'DESC')->paginate(12);

        return view('frontend.blog.blog', compact('blogs'));
    }
    public function blogDetail(string $slug)
    {
        $blog = BlogTour::where('slug', $slug)
            ->where('trangthai', 1)
            ->firstOrFail();

        $moreBlogs = BlogTour::where('slug', '!=', $slug)
            ->where('trangthai', 1)
            ->orderBy('id', 'DESC')->take(5)->get();

        $recentBlogs = BlogTour::where('slug', '!=', $slug)
            ->where('trangthai', 1)
            ->where('loaiblog_id', $blog->loaiblog_id)
            ->orderBy('id', 'DESC')->take(12)->get();

        $blogcategories = LoaiBlog::all();
        return view('frontend.blog.blog-detail', compact('blog', 'moreBlogs', 'recentBlogs', 'blogcategories'));
    }
}
