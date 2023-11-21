<?php

namespace App\Http\Controllers;

use App\Enums\Ask;
use App\Models\Blog;
use App\Models\Post;
use App\Enums\Status;
use App\Models\Category;
use App\Enums\CategoryType;
use App\Models\BreakingNews;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $data = [];
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['all_categories'] =  Category::where(['status' => Status::ACTIVE, 'type' => CategoryType::POST])->get();
        $this->data['posts'] =  Post::where(['status' => Status::ACTIVE])->where('internship', Ask::NO)->orderByDesc('id')->get();
        return view('frontend.index', $this->data);
    }

    public function all_blogs()
    {
        $blogs =  Blog::where(['status' => Status::ACTIVE])->orderByDesc('id')->get();
        return view('frontend.blogs.all', ['title' => 'All Blogs','blogs'=>$blogs]);
    }
    public function blog_details($slug)
    {
        $this->data['blog'] = Blog::with('categories')->where('slug', $slug)->first();
        if ($this->data['blog']) {
            $this->data['title'] = $this->data['blog']->title;
            $this->data['categories'] =  Category::withCount('blogs')->where(['status' => Status::ACTIVE, 'type' => CategoryType::BLOG])->get();
            return view('frontend.blogs.show', $this->data);
        }
        abort(404);
    }
    public function all_posts()
    {
        return view('frontend.posts.all', ['title' => 'All Posts']);
    }
    public function post_details($slug)
    {
        $this->data['post'] = Post::with('categories')->where('slug', $slug)->first();
        if ($this->data['post']) {
            $this->data['title'] = $this->data['post']->title;
            $this->data['categories'] =  Category::withCount('posts')->where(['status' => Status::ACTIVE, 'type' => CategoryType::POST])->get();
            // dd($this->data['post']);
            return view('frontend.posts.show', $this->data);
        }
        abort(404);
    }

    public function post_by_category($slug)
    {
        $category = Category::with('posts')->where(['slug' => $slug, 'status' => Status::ACTIVE])->first();
        return view('frontend.posts.all', ['title' => $category->name, 'posts' => $category->posts]);
    }
    public function blog_by_category($slug)
    {
        $category = Category::with('blogs')->where(['slug' => $slug, 'status' => Status::ACTIVE])->first();
        return view('frontend.blogs.all', ['title' => $category->name, 'blogs' => $category->blogs]);
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $this->data['search_location']   = $request->location;
        $this->data['search_category']   = $request->category;
        $this->data['search_remote']     = $request->remote ?? false;
        $this->data['search_internship'] = $request->internship ?? false;
        $this->data['search_keyword']    = $request->keyword;

        $posts               = (new Post())->newQuery();
        $posts->with('media');
        $posts->orderBy('created_at', 'desc')->where('status', Status::ACTIVE);
        if (!blank($request->keyword)) {
            $posts->where('title', 'like', '%' . $request->keyword . '%');
            $posts->orWhere('description', 'like', '%' . $request->keyword . '%');
        }
        if (!blank($request->location)) {
            $posts->where('location', $request->location);
        }

        if (isset($request->remote)) {
            $posts->where('remote_job', Ask::YES);
        }
        if (isset($request->internship)) {
            $posts->where('internship', Ask::YES);
        }
        
        if (!blank($request->category)) {
            $categoryId = $request->category;
            $posts->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            });
        }
        $this->data['posts'] = $posts->get();
        $this->data['all_categories'] =  Category::where(['status' => Status::ACTIVE, 'type' => CategoryType::POST])->get();
        return view('frontend.index', $this->data);
    }

    public function govtJobs()
    {
        $this->data['all_categories'] =  Category::where(['status' => Status::ACTIVE, 'type' => CategoryType::POST])->get();
        $this->data['posts'] =  Post::where(['status' => Status::ACTIVE])->where('is_gov', Ask::YES)->orderByDesc('id')->get();
        return view('frontend.index', $this->data);
    }

    public function internships()
    {
        $this->data['all_categories'] =  Category::where(['status' => Status::ACTIVE, 'type' => CategoryType::POST])->get();
        $this->data['posts'] =  Post::where(['status' => Status::ACTIVE])->where('internship', Ask::YES)->orderByDesc('id')->get();
        return view('frontend.index', $this->data);
    }
    public function remoteJobs()
    {
        $this->data['all_categories'] =  Category::where(['status' => Status::ACTIVE, 'type' => CategoryType::POST])->get();
        $this->data['posts'] =  Post::where(['status' => Status::ACTIVE])->where('remote_job', Ask::YES)->orderByDesc('id')->get();
        return view('frontend.index', $this->data);
    }
    public function projects()
    {
        $this->data['blogs'] =  Blog::where(['status' => Status::ACTIVE])->where('is_project', Ask::YES)->orderByDesc('id')->get();
        return view('frontend.blogs.all', $this->data);
    }
}
