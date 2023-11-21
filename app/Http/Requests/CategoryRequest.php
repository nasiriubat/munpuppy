<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;


use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => ['required', 'string'],
            'type'    => 'required|numeric',
            'status'    => 'required|numeric',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $category = Category::where(['name'=> request('name'),'type'=>request('type')])->first();
            if (isset($category)) {
                    $validator->errors()->add('name', 'Name already Taken.');
            }
        });
    }
}
