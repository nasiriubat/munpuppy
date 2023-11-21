@extends('admin.layouts.master')

@section('main-content')

<section class="section">
    <div class="section-header">
        <h1>{{ __('Blog') }}</h1>
        {{ Breadcrumbs::render('blog/show') }}
    </div>

    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    {{-- <div class="profile-dashboard bg-maroon-light">
                            <img src="{{$blog->image}}" alt="{{$blog->title}}">
                    <h1>{{ __('Blog Details') }}</h1>
                </div> --}}
                    <div class="profile-widget-description profile-widget-employee">
                        <dl class="row">


                            <dt class="col-sm-4">{{ __('Category') }}</dt>
                            <dd class="col-sm-8">@php
                                $categories = implode(', ', $blog->categories()->pluck('name')->toArray());
                                echo $categories;
                                @endphp</dd>

                            <dt class="col-sm-4">{{ __('Status') }}</dt>
                            <dd class="col-sm-8">{{ trans('statuses.' . $blog->status) }} </dd>
                            {{-- 
                                    <dt class="col-sm-4">{{ __('Meta Title') }}</dt>
                            <dd class="col-sm-8">{{ $blog->meta_title }}</dd>

                            <dt class="col-sm-4">{{ __('Meta Keyword') }}</dt>
                            <dd class="col-sm-8">{{ $blog->meta_keywords }}</dd>

                            <dt class="col-sm-4">{{ __('Meta Description') }}</dt>
                            <dd class="col-sm-8">{{ $blog->meta_description }}</dd>

                            <dt class="col-sm-4">{{ __('Meta Open Image') }}</dt>
                            <dd class="col-sm-8">{{ $blog->meta_og_image }}</dd>

                            <dt class="col-sm-4">{{ __('Meta Open URL') }}</dt>
                            <dd class="col-sm-8">{{ $blog->meta_og_url }}</dd> --}}
                        </dl>
                    </div>
                </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12">

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-visitor" role="tabpanel"
                    aria-labelledby="nav-visitor-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="d-block">
                                {{ $blog->title }}
                            </h2>

                        </div>
                        <div class="card-body">
                            <p>{!! $blog->description !!}</p>
                        </div>
                    </div>
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
