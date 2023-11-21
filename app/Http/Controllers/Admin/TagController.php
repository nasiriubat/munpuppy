<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Enums\Status;
use App\Enums\CategoryType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\Category\CategoryService;

class TagController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware('auth');
        $this->data['sitetitle'] = 'tag';

        $this->middleware(['permission:tag'])->only('index');
        $this->middleware(['permission:tag_create'])->only('create', 'store');
        $this->middleware(['permission:tag_edit'])->only('edit', 'update');
        $this->middleware(['permission:tag_delete'])->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return view('admin.tag.index',$this->data);
    }

    public function create(Request $request)
    {

        return view('admin.tag.create', $this->data);
    }

    public function store(TagRequest $request)
    {
        $tag         = new Tag();
        $tag->name   = $request->name;
        $tag->slug   = Str::slug($request->name);
        $tag->status = $request->status;
        $tag->type   = $request->type;

        $tag->save();
        return redirect()->route('admin.tag.index')->withSuccess('The data inserted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {

    }

    public function edit($id)
    {
        $this->data['tag'] = Tag::findOrFail($id);
        return view('admin.tag.edit', $this->data);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $tag = Tag::find($tag->id);
        $tag->name = $request->name;
        $tag->slug   = Str::slug($request->name);
        $tag->status = $request->status;
        $tag->type   = $request->type;

        $tag->save();
        return redirect()->route('admin.tag.index')->withSuccess('The data updated successfully!');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->route('admin.tag.index')->with(['success' => 'Delete successfully.']);
    }


    public function getTag(Request $request)
    {
        $tags = Tag::orderBy('id', 'desc')->get();
        $i         = 1;
        $tagArray = [];
        if (!blank($tags)) {
            foreach ($tags as $tag) {
                $tagArray[$i]          = $tag;
                $tagArray[$i]['setID'] = $i;
                $i++;
            }
        }
        return Datatables::of($tagArray)
            ->addColumn('action', function ($tag) {
                $retAction = '';
                if (auth()->user()->can('tag_edit')) {
                    $retAction .= '<a href="' . route('admin.tag.edit', $tag) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                }
                if (auth()->user()->can('tag_delete')) {
                    $retAction .= '<form class="float-left pl-2" action="' . route('admin.tag.destroy', $tag) . '" method="POST">' . method_field('DELETE') . csrf_field() . '<button class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></form>';
                }
                return $retAction;
            })
            ->editColumn('name', function ($tag) {
                return $tag->name;
            })
            ->editColumn('type', function ($tag) {
                return ($tag->type == 1 ? trans('category_type.' . CategoryType::POST) : trans('category_type.' . CategoryType::BLOG));
            })
            ->editColumn('status', function ($tag) {
                return ($tag->status == 5 ? trans('statuses.' . Status::ACTIVE) : trans('statuses.' . Status::INACTIVE));
            })
            ->editColumn('id', function ($tag) {
                return $tag->setID;
            })
            ->make(true);
    }



}
