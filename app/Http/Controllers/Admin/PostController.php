<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Tag;
use App\Models\Post;
use App\Enums\Status;
use App\Models\Category;
use App\Enums\CategoryType;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->data['sitetitle'] = 'Post';

        $this->middleware(['permission:post'])->only('index');
        $this->middleware(['permission:post_create'])->only('create', 'store');
        $this->middleware(['permission:post_edit'])->only('edit', 'update');
        $this->middleware(['permission:post_delete'])->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index', $this->data);
    }

    public function create()
    {
        $this->data['categores'] = Category::where(['type' => CategoryType::POST, 'status' => Status::ACTIVE])->get();
        $this->data['tags']      = Tag::where(['type' => CategoryType::POST,'status'=>Status::ACTIVE])->get();

        return view('admin.post.create', $this->data);
    }

    public function store(PostRequest $request)
    {
        DB::beginTransaction();
        try {
            $post = Post::create(Arr::except($request->validated(),['categories','tags']) + ['slug' => Str::slug($request->title)]);
            $post->categories()->sync($request->get('categories'));
            $post->tags()->sync($request->get('tags'));
            //Store Image Media Libraty Spati
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $post->addMediaFromRequest('image')->toMediaCollection('posts');
            }
          
            DB::commit();
            return redirect(route('admin.post.index'))->withSuccess('The data inserted successfully.');
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->data['post'] = $post;
        $this->data['categores'] = Category::where(['type' => CategoryType::POST, 'status' => Status::ACTIVE])->get();
        $this->data['category_posts'] = $post->categories->pluck('id')->toArray();
        $this->data['tags']      = Tag::where(['type' => CategoryType::POST,'status'=>Status::ACTIVE])->get();
        $this->data['post_tags'] = $post->tags->pluck('id')->toArray();

        return view('admin.post.edit', $this->data);
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update(Arr::except($request->validated(),['categories','tags']) + ['slug' => Str::slug($request->title)]);
        $post->categories()->sync($request->get('categories'));
        $post->tags()->sync($request->get('tags'));

        $post->save();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $post->clearMediaCollection('posts');
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }
        return redirect(route('admin.post.index'))->withSuccess('The data updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->categories()->detach();
        if (isset($post->image)) {
            $post->clearMediaCollection('posts');
        }
        $post->delete();
        return redirect()->route('admin.post.index')->with(['success' => 'Delete successfully.']);
    }


    public function getPost(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')->get();
        $i         = 1;
        $postArray = [];
        if (!blank($posts)) {
            foreach ($posts as $post) {
                $postArray[$i]          = $post;
                $postArray[$i]['setID'] = $i;
                $i++;
            }
        }
        return Datatables::of($postArray)
            ->addColumn('action', function ($post) {
                $retAction = '';
                if (auth()->user()->can('post_edit')) {
                    $retAction .= '<a href="' . route('admin.post.edit', $post) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                }
                if (auth()->user()->can('post_show')) {
                    $retAction .= '<a href="' . route('admin.post.show', $post) . '" class="ml-2 btn btn-sm btn-icon float-left btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="far fa-eye"></i></a>';
                }
                if (auth()->user()->can('post_delete')) {
                    $retAction .= '<form class="float-left pl-2" action="' . route('admin.post.destroy', $post) . '" method="POST">' . method_field('DELETE') . csrf_field() . '<button class="btn btn-sm btn-icon btn-danger delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></form>';
                }
                return $retAction;
            })
            ->editColumn('title', function ($post) {
                return $post->title;
            })

            ->editColumn('status', function ($post) {
                return ($post->status == 5 ? trans('statuses.' . Status::ACTIVE) : trans('statuses.' . Status::INACTIVE));
            })
            ->editColumn('id', function ($post) {
                return $post->setID;
            })
            ->make(true);
    }
}
