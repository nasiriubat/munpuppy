@extends('admin.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datetimepicker/jquery.datetimepicker.min.css') }}">
@endsection

@section('main-content')

<section class="section">
    <div class="section-header">
        <h1>{{ __('Blog') }}</h1>
        {{ Breadcrumbs::render('blog/edit') }}
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.blog.update',$blog) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-lg-8">
                                    <label for="title">{{ __('Title') }}</label> <span class="text-danger">*</span>
                                    <input id="title" type="text" name="title" class="form-control {{ $errors->has('title') ? " is-invalid " : '' }}" value="{{ old('title',$blog->title) }}">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-8">
                                    <label for="youtube_link">{{ __('youtube_link') }}</label>
                                    <input id="youtube_link" type="text" name="youtube_link" class="form-control {{ $errors->has('youtube_link') ? " is-invalid " : '' }}" value="{{ old('youtube_link',$blog->youtube_link) }}">
                                    @error('youtube_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="categories">{{ __('Category') }}</label> <span class="text-danger">*</span>
                                    <select id="categories" name="categories[]" multiple class="form-control select2 @error('categories') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @if(!blank($categores))
                                        @foreach($categores as $category)
                                        <!-- @if(in_array($category->id,$blog_category))
                                        <option selected value="{{ $category->id }}"> {{ $category->name }}</option>
                                        @else
                                        <option  value="{{ $category->id }}"> {{ $category->name }}</option>
                                        @endif -->
                                        <option value="{{ $category->id }}" {{in_array($category->id,(old('categories') ?? $blog_category )) ? 'selected' : ''}}> {{ $category->name }}</option>

                                        @endforeach
                                        @endif
                                    </select>
                                    @error('categories')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>




                                <div class="form-group col-lg-6">
                                    <label for="status">{{ __('Status') }}</label> <span class="text-danger">*</span>
                                    <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                        @foreach(trans('statuses') as $key => $status)
                                        <option value="{{ $key }}" {{ (old('status',$blog->status) == $key) ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="is_project">{{ __('Project') }}</label> <span class="text-danger">*</span>
                                    <select id="is_project" name="is_project" class="form-control select2 @error('is_project') is-invalid @enderror">
                                        @foreach(trans('ask') as $key => $value)
                                        <option value="{{ $key }}" {{ (old('is_project',$blog->is_project) == $key ) ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('is_project')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="tags">{{ __('Tag') }}</label> <span class="text-danger">*</span>
                                    <select id="tags" name="tags[]" multiple class="form-control select2 @error('tags') is-invalid @enderror">
                                        <option value="">Select Tag</option>
                                        @if(!blank($tags))
                                        @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{in_array($tag->id,(old('tags') ?? $blog_tags)) ? 'selected' : '' }}> {{ $tag->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('tags')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="description">{{ __('Description') }}</label> <span class="text-danger">*</span>
                                    <textarea name="description" class="summernote form-control {{ $errors->has('description') ? " is-invalid " : '' }}" id="" cols="30" rows="10">{{old('description',$blog->description)}}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="meta_title">{{ __('Meta Title') }}</label>
                                    <input id="meta_title" type="text" name="meta_title" class="form-control {{ $errors->has('meta_title') ? " is-invalid " : '' }}" value="{{ old('meta_title',$blog->meta_title) }}">
                                    @error('meta_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="meta_keywords">{{ __('Meta Keywords') }}</label>
                                    <input id="meta_keywords" type="text" name="meta_keywords" class="form-control {{ $errors->has('meta_keywords') ? " is-invalid " : '' }}" value="{{ old('meta_keywords',$blog->meta_keywords) }}">
                                    @error('meta_keywords')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="meta_description">{{ __('Meta Description') }}</label>
                                    <input id="meta_description" type="text" name="meta_description" class="form-control {{ $errors->has('meta_description') ? " is-invalid " : '' }}" value="{{ old('meta_description',$blog->meta_description) }}">
                                    @error('meta_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="meta_og_image">{{ __('Meta Open Graph image') }}</label>
                                    <input id="meta_og_image" type="text" name="meta_og_image" class="form-control {{ $errors->has('meta_og_image') ? " is-invalid " : '' }}" value="{{ old('meta_og_image',$blog->meta_og_image) }}">
                                    @error('meta_og_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="meta_og_url">{{ __('Meta Open Graph URL') }}</label>
                                    <input id="meta_og_url" type="text" name="meta_og_url" class="form-control {{ $errors->has('meta_og_url') ? " is-invalid " : '' }}" value="{{ old('meta_og_url',$blog->meta_og_url) }}">
                                    @error('meta_og_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="customFile">{{ __('Banner Image') }}</label>
                                    <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" onchange="readURL(this);">
                                        <label class="custom-file-label" for="customFile">{{ __('Choose File') }}</label>
                                    </div>
                                    @if ($errors->has('image'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('image') }}
                                    </div>
                                    @endif
                                    <img class="img-thumbnail image-width mt-4 mb-3" id="previewImage" src="{{ $blog->image }}" alt="your image" />
                                </div>
                            </div>
                        </div>
                </div>
                <button class="btn btn-primary mr-1" type="submit">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('assets/modules/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('js/post/create.js') }}"></script>

@endsection