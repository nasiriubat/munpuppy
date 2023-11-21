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
        <h1>{{ __('Post') }}</h1>
        {{ Breadcrumbs::render('post/add') }}
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                            
                                <div class="form-group col-lg-8">
                                    <label for="title">{{ __('Title') }}</label> <span class="text-danger">*</span>
                                    <input id="title" type="text" name="title"
                                        class="form-control {{ $errors->has('title') ? " is-invalid " : '' }}"
                                        value="{{ old('title') }}">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="categories">{{ __('Category') }}</label> <span
                                        class="text-danger">*</span>
                                    <select id="categories" name="categories[]" multiple
                                        class="form-control select2 @error('categories') is-invalid @enderror">
                                        @if(!blank($categores))
                                        @foreach($categores as $category)
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id,(old('categories') ?? [])) ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('categories')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="description">{{ __('Description') }}</label> <span
                                        class="text-danger">*</span>
                                    <textarea name="description"
                                        class="summernote form-control {{ $errors->has('description') ? " is-invalid " : '' }}"
                                        id="" cols="30" rows="10">{{old('description')}}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="is_gov">{{ __('Government Job') }}</label> <span class="text-danger">*</span>
                                    <select id="is_gov" name="is_gov"
                                        class="form-control select2 @error('is_gov') is-invalid @enderror">
                                        @foreach(trans('ask') as $key => $value)
                                        <option value="{{ $key }}" {{ (old('is_gov') == $key || $key == App\Enums\Ask::NO) ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('is_gov')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="remote_job">{{ __('Remote Job') }}</label> <span class="text-danger">*</span>
                                    <select id="remote_job" name="remote_job"
                                        class="form-control select2 @error('remote_job') is-invalid @enderror">
                                        @foreach(trans('ask') as $key => $value)
                                        <option value="{{ $key }}" {{ (old('value') == $key || $key == App\Enums\Ask::NO) ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('remote_job')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="internship">{{ __('Internship') }}</label> <span class="text-danger">*</span>
                                    <select id="internship" name="internship"
                                        class="form-control select2 @error('internship') is-invalid @enderror">
                                        @foreach(trans('ask') as $key => $value)
                                        <option value="{{ $key }}" {{ (old('internship') == $key || $key == App\Enums\Ask::NO) ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('internship')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="location">{{ __('Location') }}</label> <span class="text-danger">*</span>
                                    <select id="location" name="location"
                                        class="form-control select2 @error('location') is-invalid @enderror">
                                        @foreach(trans('district') as $key => $value)
                                        <option value="{{ $key }}" {{ (old('value') == $key) ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-lg-6">
                                    <label for="deadline">{{ __('Deadline') }}</label> <span class="text-danger">*</span>
                                    <input id="deadline" type="text" name="deadline" id="deadline"
                                        class="form-control {{ $errors->has('deadline') ? " is-invalid " : '' }}"
                                        value="{{ old('deadline') }}">
                                    @error('deadline')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="apply_link">{{ __('Apply link') }}</label>
                                    <input id="apply_link" type="text" name="apply_link" id="apply_link"
                                        class="form-control {{ $errors->has('apply_link') ? " is-invalid " : '' }}"
                                        value="{{ old('apply_link') }}">
                                    @error('apply_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                               
                                <div class="form-group col-lg-6">
                                    <label for="tag_id">{{ __('Tag') }}</label> <span
                                        class="text-danger">*</span>
                                    <select id="tag_id" name="tags[]" multiple
                                        class="form-control select2 @error('tags') is-invalid @enderror">
                                        @if(!blank($tags))
                                        @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                        {{ in_array($tag->id,(old('tags') ?? [])) ? 'selected' : '' }}>
                                            {{ $tag->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('tags')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="status">{{ __('Status') }}</label> <span class="text-danger">*</span>
                                    <select id="status" name="status"
                                        class="form-control select2 @error('status') is-invalid @enderror">
                                        @foreach(trans('statuses') as $key => $status)
                                        <option value="{{ $key }}" {{ (old('status') == $key) ? 'selected' : '' }}>
                                            {{ $status }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            
                                <div class="form-group col-lg-6">
                                    <label for="meta_title">{{ __('Meta Title') }}</label>
                                    <input id="meta_title" type="text" name="meta_title"
                                        class="form-control {{ $errors->has('meta_title') ? " is-invalid " : '' }}"
                                        value="{{ old('meta_title') }}">
                                    @error('meta_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="meta_keywords">{{ __('Meta Keywords') }}</label>
                                    <input id="meta_keywords" type="text" name="meta_keywords"
                                        class="form-control {{ $errors->has('meta_keywords') ? " is-invalid " : '' }}"
                                        value="{{ old('meta_keywords') }}">
                                    @error('meta_keywords')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="meta_description">{{ __('Meta Description') }}</label>
                                    <input id="meta_description" type="text" name="meta_description"
                                        class="form-control {{ $errors->has('meta_description') ? " is-invalid " : '' }}"
                                        value="{{ old('meta_description') }}">
                                    @error('meta_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="meta_og_image">{{ __('Meta Open Graph image') }}</label>
                                    <input id="meta_og_image" type="text" name="meta_og_image"
                                        class="form-control {{ $errors->has('meta_og_image') ? " is-invalid " : '' }}"
                                        value="{{ old('meta_og_image') }}">
                                    @error('meta_og_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="meta_og_url">{{ __('Meta Open Graph URL') }}</label>
                                    <input id="meta_og_url" type="text" name="meta_og_url"
                                        class="form-control {{ $errors->has('meta_og_url') ? " is-invalid " : '' }}"
                                        value="{{ old('meta_og_url') }}">
                                    @error('meta_og_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="customFile">{{ __('Banner Image') }}</label>
                                    <div class="custom-file">
                                        <input name="image" type="file"
                                            class="custom-file-input @error('image') is-invalid @enderror"
                                            id="customFile" onchange="readURL(this);">
                                        <label class="custom-file-label"
                                            for="customFile">{{ __('Choose File') }}</label>
                                    </div>
                                    @if ($errors->has('image'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('image') }}
                                    </div>
                                    @endif
                                    <img class="img-thumbnail image-width mt-4 mb-3" id="previewImage"
                                        src="{{ asset('assets/img/default/user.png') }}" alt="your image" />
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
