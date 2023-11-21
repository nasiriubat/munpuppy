<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Ask;
use Exception;
use App\Models\Tag;
use App\Models\Blog;
use App\Enums\Status;
use App\Models\Category;
use App\Enums\CategoryType;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->data['sitetitle'] = 'Blog';

        $this->middleware(['permission:blog'])->only('index');
        $this->middleware(['permission:blog_create'])->only('create', 'store');
        $this->middleware(['permission:blog_edit'])->only('edit', 'update');
        $this->middleware(['permission:blog_delete'])->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blog.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->data['categores'] = Category::where(['type' => CategoryType::BLOG, 'status' => Status::ACTIVE])->get();
        $this->data['tags']      = Tag::where(['type' => CategoryType::BLOG, 'status' => Status::ACTIVE])->get();

        return view('admin.blog.create', $this->data);
    }

    public function store(BlogRequest $request)
    {

        DB::beginTransaction();
        try {
            $blog = Blog::create(Arr::except($request->validated(), ['categories', 'tags']) + ['slug' => Str::slug($request->title)]);
            $blog->categories()->sync($request->get('categories'));
            $blog->tags()->sync($request->get('tags'));

            //Store Image Media Libraty Spati
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $blog->addMediaFromRequest('image')->toMediaCollection('blogs');
            }
            DB::commit();
            return redirect(route('admin.blog.index'))->withSuccess('The data inserted successfully.');
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
    public function show(Blog $blog)
    {
        return view('admin.blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $this->data['blog'] = $blog;
        $this->data['categores'] = Category::where(['type' => CategoryType::BLOG, 'status' => Status::ACTIVE])->get();
        $this->data['blog_category'] = $blog->categories()->pluck('categories.id')->toArray();
        $this->data['tags']      = Tag::where(['type' => CategoryType::BLOG, 'status' => Status::ACTIVE])->get();
        $this->data['blog_tags'] = $blog->tags()->pluck('tags.id')->toArray();
        return view('admin.blog.edit', $this->data);
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update(Arr::except($request->validated(), ['categories', 'tags']) + ['slug' => Str::slug($request->title)]);
        $blog->categories()->sync($request->get('categories'));
        $blog->tags()->sync($request->get('tags'));

        $blog->save();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $blog->clearMediaCollection('blogs');

            $blog->addMediaFromRequest('image')->toMediaCollection('blogs');
        }
        return redirect(route('admin.blog.index'))->withSuccess('The data updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->tags()->detach();
        $blog->categories()->detach();
        if (isset($blog->image)) {
            $blog->clearMediaCollection('blogs');
        }
        $blog->delete();
        return redirect()->route('admin.blog.index')->with(['success' => 'Delete successfully.']);
    }


    public function getBlog(Request $request)
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        $i         = 1;
        $blogArray = [];
        if (!blank($blogs)) {
            foreach ($blogs as $blog) {
                $blogArray[$i]          = $blog;
                $blogArray[$i]['setID'] = $i;
                $i++;
            }
        }
        return Datatables::of($blogArray)
            ->addColumn('action', function ($blog) {
                $retAction = '';
                if (auth()->user()->can('blog_edit')) {
                    $retAction .= '<a href="' . route('admin.blog.edit', $blog) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                }
                if (auth()->user()->can('blog_show')) {
                    $retAction .= '<a href="' . route('admin.blog.show', $blog) . '" class="ml-2 btn btn-sm btn-icon float-left btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="far fa-eye"></i></a>';
                }
                if (auth()->user()->can('blog_delete')) {
                    $retAction .= '<form class="float-left pl-2" action="' . route('admin.blog.destroy', $blog) . '" method="POST">' . method_field('DELETE') . csrf_field() . '<button class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></form>';
                }
                return $retAction;
            })
            ->editColumn('title', function ($blog) {
                return Str::limit($blog->title,50) ;
            })

            ->editColumn('is_project', function ($blog) {
                return ($blog->is_project == Ask::YES ? 'Yes' : 'No');
            })
            ->editColumn('status', function ($blog) {
                return ($blog->status == 5 ? trans('statuses.' . Status::ACTIVE) : trans('statuses.' . Status::INACTIVE));
            })
            ->editColumn('id', function ($blog) {
                return $blog->setID;
            })
            ->make(true);
    }
}
