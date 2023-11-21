<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;


use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'description'      => ['required', 'string'],
            'apply_link'       => ['nullable', 'string'],
            'categories'     => 'required',
            'tags'           => 'required',
            'is_gov'           => 'required|numeric',
            'remote_job'       => 'required|numeric',
            'internship'       => 'required|numeric',
            'deadline'         => 'required',
            'location'         => 'required',
            'status'           => 'required|numeric',
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
