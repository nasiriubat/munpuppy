<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Post;
use App\Enums\Status;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SitemapController extends Controller
{

    public function index(Request $r)
    {

        $posts = Post::orderBy('id', 'desc')->where('status', Status::ACTIVE)->get();
        $blogs = Blog::orderBy('id', 'desc')->where('status', Status::ACTIVE)->get();

        return response()->view('admin.sitemap', compact('posts','blogs'))
            ->header('Content-Type', 'text/xml');
    }
}
