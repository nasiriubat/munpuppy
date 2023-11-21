<?php

namespace App\Http\Requests;

use App\Models\Tag;
use Illuminate\Validation\Rule;


use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name'      => ['required', 'string','max:1000'],
            'type'    => 'required|numeric',
            'status'    => 'required|numeric',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tag = Tag::where(['name'=> request('name'),'type'=>request('type')])->first();
            if (isset($tag)) {
                    $validator->errors()->add('name', 'Name already Taken.');
            }
        });
    }
}
