<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\BreakingNewsRequest;
use App\Models\Post;
use App\Models\BreakingNews;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class BreakingNewsController extends Controller
{

    public function __construct()
    {
      
        $this->middleware('auth');
        $this->data['sitetitle'] = 'Breaking News';

        // $this->middleware(['permission:breaking-news'])->only('index');
        // $this->middleware(['permission:breaking-news_create'])->only('create', 'store');
        // $this->middleware(['permission:breaking-news_edit'])->only('edit', 'update');
        // $this->middleware(['permission:breaking-news_delete'])->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.breaking-news.index',$this->data);
    }

    public function create(Request $request)
    {
        $this->data['posts'] = Post::where('status',Status::ACTIVE)->get();
        return view('admin.breaking-news.create', $this->data);
    }

    public function store(BreakingNewsRequest $request)
    {
        $breakingNews                   = new BreakingNews;
        $breakingNews->title            = $request->title;
        $breakingNews->post_id      = $request->post_id;
        $breakingNews->status           = $request->status;
        $breakingNews->save();

        return redirect(route('admin.breakingnews.index'))->withSuccess('The data inserted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
 

    public function edit($id)
    {
        $this->data['posts'] = Post::where('status',Status::ACTIVE)->get();
        $this->data['breakingnewse'] = BreakingNews::findOrFail($id);
        return view('admin.breaking-news.edit', $this->data);
    }

    public function update(BreakingNewsRequest $request, $id)
    {
        $breakingNews              = BreakingNews::findOrFail($id);
        $breakingNews->title            = $request->title;
        $breakingNews->post_id      = $request->post_id;
        $breakingNews->status           = $request->status;
        $breakingNews->save();
        return redirect(route('admin.breakingnews.index'))->withSuccess('The data updated successfully.');
    }

    public function destroy($id)
    {
        BreakingNews::findOrFail($id)->delete();
        return redirect()->route('admin.breakingnews.index')->with(['success' => 'Delete successfully.']);
    }


    public function getBreakingNews(Request $request)
    {
        $breakingNews = BreakingNews::orderBy('id', 'desc')->get();
        $i         = 1;
        $breakingArray = [];
        if (!blank($breakingNews)) {
            foreach ($breakingNews as $breaking) {
                $breakingArray[$i]          = $breaking;
                $breakingArray[$i]['setID'] = $i;
                $i++;
            }
        }
        return Datatables::of($breakingArray)
            ->addColumn('action', function ($breaking) {
                $retAction = '';
                if (auth()->user()->can('breakingnews_edit')) {
                    $retAction .= '<a href="' . route('admin.breakingnews.edit', $breaking) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                }    
         
                if (auth()->user()->can('breakingnews_delete')) {
                    $retAction .= '<form class="float-left pl-2" action="' . route('admin.breakingnews.destroy', $breaking) . '" method="POST">' . method_field('DELETE') . csrf_field() . '<button class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></form>';
                }
                return $retAction;
            })
            ->editColumn('title', function ($breaking) {
                return $breaking->title;
            })
            ->editColumn('post', function ($breaking) {
                return  !blank($breaking->post_id) ?  Str::limit($breaking->post->title, 100) : '';
            })
            // ->editColumn('post', function ($post) {
            //     return Str::limit($post->content, 100);
            // })
            ->editColumn('status', function ($breaking) {
                return ($breaking->status == 5 ? trans('statuses.' . Status::ACTIVE) : trans('statuses.' . Status::INACTIVE));
            })
            ->editColumn('id', function ($breaking) {
                return $breaking->setID;
            })
            ->make(true);
    }



}
