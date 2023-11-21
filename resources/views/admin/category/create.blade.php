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
        <h1>{{ __('Category') }}</h1>
        {{ Breadcrumbs::render('category/add') }}
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="name">{{ __('Name') }}</label> <span class="text-danger">*</span>
                                    <input id="name" type="text" name="name"
                                        class="form-control {{ $errors->has('name') ? " is-invalid " : '' }}"
                                        value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="type">{{ __('Type') }}</label> <span class="text-danger">*</span>
                                    <select id="type" name="type"
                                        class="form-control @error('type') is-invalid @enderror">
                                        @foreach(trans('category_type') as $key => $type)
                                        <option value="{{ $key }}" {{ (old('type') == $key) ? 'selected' : '' }}>
                                            {{ $type }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="status">{{ __('Status') }}</label> <span class="text-danger">*</span>
                                <select id="status" name="status"
                                    class="form-control @error('status') is-invalid @enderror">
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

@endsection
