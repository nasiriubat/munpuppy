@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('main-content')

    <section class="section">
        <div class="section-header">
        <h1>{{ __('Breaking News') }}</h1>
            {{ Breadcrumbs::render('breakingnews/edit') }}
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                    <form action="{{ route('admin.breakingnews.update', $breakingnewse) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                            <label for="category_id">{{ __('post') }}</label> <span class="text-danger">*</span>
                                            <select id="post_id" name="post_id" class="form-control select2 @error('post_id') is-invalid @enderror">
                                                <option value="">Select post</option>
                                                @if(!blank($posts))
                                                @foreach($posts as $post)
                                                    <option value="{{ $post->id }}" {{ (old('post_id') == $post->id || $breakingnewse->post_id == $post->id ) ? 'selected' : '' }}>{{ $post->title }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('post_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="title">{{ __('Title') }}</label> <span class="text-danger">*</span>
                                        <input id="title" type="text" name="title" class="form-control {{ $errors->has('title') ? " is-invalid " : '' }}" value="{{ old('title',$breakingnewse->title) }}">
                                        @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label for="status">{{ __('Status') }}</label> <span class="text-danger">*</span>
                                        <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                            @foreach(trans('statuses') as $key => $status)
                                                <option value="{{ $key }}" {{ (old('status') == $key || $breakingnewse->status == $key) ? 'selected' : '' }}>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mr-1" type="submit">{{ __('Update') }}</button>
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
    <script src="{{ asset('assets/modules/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

@endsection
