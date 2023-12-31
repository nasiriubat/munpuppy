<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;


use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'            => ['required', 'string'],
            'youtube_link'     => ['nullable','string'],
            'description'      => ['required', 'string'],
            'categories'       => 'required',
            'tags'             => 'required',
            'status'           => 'required|numeric',
            'is_project'       => 'required|numeric',
            'meta_title'       => ['nullable', 'string'],
            'meta_keywords'    => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_og_image'    => ['nullable', 'string'],
            'meta_og_url'      => ['nullable', 'string'],
            'meta_og_url'      => ['nullable', 'string'],
            'published_at'     => ['nullable'],
            'image'            => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ];
    }
}
