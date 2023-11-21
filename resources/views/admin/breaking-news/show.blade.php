@extends('admin.layouts.master')

@section('main-content')

    <section class="section">
        <div class="section-header">
            <h1>{{ __('Post') }}</h1>
            {{ Breadcrumbs::render('post/show') }}
        </div>

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card">
                        <div class="profile-dashboard bg-maroon-light">
                            <img src="{{$post->image}}" alt="{{$post->title}}">
                            <h1>{{ __('Post Details') }}</h1>
                        </div>
                        <div class="profile-widget-description profile-widget-employee">
                            <dl class="row">
                                <dt class="col-sm-4">{{ __('Title') }}</dt>
                                <dd class="col-sm-8">{{ $post->title }}</dd>
                                
                                <dt class="col-sm-4">{{ __('Category') }}</dt>
                                <dd class="col-sm-8">{{ $post->category->name }}</dd>

                                <dt class="col-sm-4">{{ __('Status') }}</dt>
                                <dd class="col-sm-8">{{ trans('statuses.' . $post->status) }} </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                   
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-visitor" role="tabpanel"
                             aria-labelledby="nav-visitor-tab">
                            <div class="card">
                                <div class="card-body">
                                    <p>{!! $post->description !!}</p>
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
