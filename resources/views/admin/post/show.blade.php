@extends('admin.layouts.master')

@section('main-content')

    <section class="section">
        <div class="section-header">
            <h1>{{ __('Post') }}</h1>
            {{ Breadcrumbs::render('post/show') }}
        </div>

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-8">
                   
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-visitor" role="tabpanel"
                             aria-labelledby="nav-visitor-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h2>{{ $post->title }}</h2>
                                </div>
                                <div class="card-body">
                                    <p>{!! $post->description !!}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card">
                        {{-- @if(!blank($post->image))
                        <div class="profile-dashboard bg-maroon-light">
                            <img src="{{$post->image}}" alt="{{$post->title}}">
                            <h1>{{ __('Post Details') }}</h1>
                        </div>
                        @endif --}}
                        <div class="profile-widget-description profile-widget-employee">
                            <dl class="row">
                                <dt class="col-sm-4">{{ __('Category') }}</dt>
                                <dd class="col-sm-8">@php
                                    $categories = implode(', ', $post->categories()->pluck('name')->toArray());
                                    echo $categories;
                                 @endphp</dd>
                                <dt class="col-sm-4">{{ __('Government') }}</dt>
                                <dd class="col-sm-8"> {{ !blank($post->is_gov) ? trans('ask.' . $post->is_gov) : '' }} </dd>

                                <dt class="col-sm-4">{{ __('Remote') }}</dt>
                                <dd class="col-sm-8"> {{ !blank($post->remote_job) ? trans('ask.' . $post->remote_job) : '' }} </dd>

                                <dt class="col-sm-4">{{ __('Internship') }}</dt>
                                <dd class="col-sm-8"> {{ !blank($post->internship) ? trans('ask.' . $post->internship) : '' }} </dd>
                                
                                <dt class="col-sm-4">{{ __('Location') }}</dt>
                                <dd class="col-sm-8">{{ $post->location }}</dd>

                                <dt class="col-sm-4">{{ __('Apply link') }}</dt>
                                <dd class="col-sm-8"><a href="{{ $post->apply_link }}">Apply</a></dd>

                                <dt class="col-sm-4">{{ __('Status') }}</dt>
                                <dd class="col-sm-8">{{ trans('statuses.' . $post->status) }} </dd>

                                 {{-- <dt class="col-sm-4">{{ __('Meta Title') }}</dt>
                                <dd class="col-sm-8">{{ $post->meta_title }}</dd>

                                <dt class="col-sm-4">{{ __('Meta Keyword') }}</dt>
                                <dd class="col-sm-8">{{ $post->meta_keywords }}</dd>

                                <dt class="col-sm-4">{{ __('Meta Description') }}</dt>
                                <dd class="col-sm-8">{{ $post->meta_description }}</dd>

                                <dt class="col-sm-4">{{ __('Meta Open Image') }}</dt>
                                <dd class="col-sm-8">{{ $post->meta_og_image }}</dd>

                                <dt class="col-sm-4">{{ __('Meta Open URL') }}</dt>
                                <dd class="col-sm-8">{{ $post->meta_og_url }}</dd> --}}

                                <dt class="col-sm-4">{{ __('Deadline') }}</dt>
                                <dd class="col-sm-8">{{ !blank($post->deadline) ?  date('D-M-Y h:m',strtotime($post->deadline)) : ''  }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/employee/view.js') }}"></script>
@endsection
