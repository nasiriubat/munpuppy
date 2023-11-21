<?php

namespace App\Http\Services\Category;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CategoryRequest;


class CategoryService
{
    /**
     * @param Request $request
     * @param int $limit
     * @return mixed
     */
    public function all()
    {
        return Category::orderBy('id', 'desc')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Category::findorFail($id);
    }

    public function make(CategoryRequest $request)
    {
        $data['name']   = $request->input('name');
        $data['slug']   = Str::slug($request->input('name'));
        $data['status'] = $request->input('status');
        $data['type']   = $request->input('type');
              $result   = Category::create($data);
        return $result;

    }


    public function update($id, CategoryRequest $request)
    {
              $category = Category::find($id);
        $data['name']   = $request->input('name');
        $data['slug']   = Str::slug($request->input('name'));
        $data['status'] = $request->input('status');
        $data['type']   = $request->input('type');
        $category->update($data);
        return $category;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $Category = Category::find($id);
        $Category->delete();
        return true;
    }

  
}
