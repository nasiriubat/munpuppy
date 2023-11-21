<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

use App\Http\Services\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware('auth');
        $this->data['sitetitle'] = 'Category';

        $this->middleware(['permission:category'])->only('index');
        $this->middleware(['permission:category_create'])->only('create', 'store');
        $this->middleware(['permission:category_edit'])->only('edit', 'update');
        $this->middleware(['permission:category_delete'])->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return view('admin.category.index',$this->data);
    }

    public function create(Request $request)
    {

        return view('admin.category.create', $this->data);
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->make($request);
        return redirect()->route('admin.category.index')->withSuccess('The data inserted successfully!');
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
        $this->data['category'] = $this->categoryService->find($id);
        return view('admin.category.edit', $this->data);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryService->update($category->id, $request);
        return redirect()->route('admin.category.index')->withSuccess('The data updated successfully!');
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('admin.category.index')->with(['success' => 'Delete successfully.']);
    }


    public function getCategory(Request $request)
    {
        $categorys = Category::orderBy('id', 'desc')->get();
        $i         = 1;
        $categoryArray = [];
        if (!blank($categorys)) {
            foreach ($categorys as $category) {
                $categoryArray[$i]          = $category;
                $categoryArray[$i]['setID'] = $i;
                $i++;
            }
        }
        return Datatables::of($categoryArray)
            ->addColumn('action', function ($category) {
                $retAction = '';
                if (auth()->user()->can('category_edit')) {
                    $retAction .= '<a href="' . route('admin.category.edit', $category) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                }
                if (auth()->user()->can('category_delete')) {
                    $retAction .= '<form class="float-left pl-2" action="' . route('admin.category.destroy', $category) . '" method="POST">' . method_field('DELETE') . csrf_field() . '<button class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></form>';
                }
                return $retAction;
            })
            ->editColumn('name', function ($category) {
                return $category->name;
            })
            ->editColumn('type', function ($category) {
                return ($category->type == 1 ? trans('category_type.' . CategoryType::POST) : trans('category_type.' . CategoryType::BLOG));
            })
            ->editColumn('status', function ($category) {
                return ($category->status == 5 ? trans('statuses.' . Status::ACTIVE) : trans('statuses.' . Status::INACTIVE));
            })
            ->editColumn('id', function ($category) {
                return $category->setID;
            })
            ->make(true);
    }



}
