@extends('frontend.layouts.frontend')
@push('css')

@endpush

@section('content')
<section class="section">
    <div class="container">
        <!-- mobile -->
        <div class="mobile-search">
            <a class="btn btn-primary mb-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <span class="float-left">Advance Search</span><i class="fas fa-search float-right"></i>
            </a>
            <div class="collapse" id="collapseExample">
                <form class="row" id="search-form" action="{{route('search')}}" method="POST">
                    @csrf
                    <div class="col-lg-10 offset-lg-1">
                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <select class="form-control" id="" name="location">
                                        <option value="">Select Location</option>
                                        @foreach(trans('district') as $key => $value)
                                        <option value="{{ $key }}" @selected(($search_location ?? '' )==$key)>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <select name="category" class="form-control" style="border-radius: 0px" ;>
                                        <option value="">Select Category</option>
                                        @foreach($all_categories as $single)
                                        <option value="{{$single->id}}" @selected(($search_category ?? '' )==$single->id)>{{$single->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="" name="keyword" placeholder="Search" value="{{$search_keyword ?? ''}}" style="border-radius:0px;">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border-radius:0px;">Search Job</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 col-sm-6 mx-auto  d-flex justify-content-between">
                                <div class="">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remote" @checked( $search_remote ?? false) name="remote">
                                        <label class="form-check-label" for="exampleCheck1">Remote</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="internship" @checked( $search_internship ?? false) name="internship">
                                        <label class="form-check-label" for="exampleCheck1">Internship</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- monitor -->
        <div class="monitor-search">
            <form class="row" action="{{route('search')}}" id="search-form" method="POST">
                @csrf
                <div class="col-lg-10 offset-lg-1">
                    <div class="row mb-2">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select class="form-control select2" id="" name="location">
                                    <option value="">Select Location</option>
                                    @foreach(trans('district') as $key => $value)
                                    <option value="{{ $key }}" @selected(($search_location ?? '' )==$key)>
                                        {{ $value }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select name="category" class="form-control" style="border-radius: 0px" ;>
                                    <option value="">Select Category</option>
                                    @foreach($all_categories as $single)
                                    <option value="{{$single->id}}" @selected(($search_category ?? '' )==$single->id)>{{$single->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="keyword" placeholder="Search" value="{{$search_keyword ?? ''}}" style="border-radius:0px;">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg btn-block" style="border-radius:0px;">Search Job</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 col-sm-6 mx-auto  d-flex justify-content-between">
                            <div class="">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" @checked( $search_remote ?? false) name="remote">
                                    <label class="form-check-label" for="exampleCheck1">Remote</label>
                                </div>
                            </div>
                            <div class="">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" @checked( $search_internship ?? false) name="internship">
                                    <label class="form-check-label" for="exampleCheck1">Internship</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <div class="row no-gutters-lg mt-2">
            <div class="col-lg-8 mb-5 mb-lg-0 mt-2">
                <div class="widget-list d-flex justify-content-between flex-wrap index-post">
                    @foreach($posts as $post)
                    <div class="article-card p-2 mb-2 index-single-post" style="width: 49%;">
                        <a class="media align-items-center" href="{{route('post-details',['slug'=>$post->slug])}}">
                            <div class="media-body ml-3">
                                <h3 style="margin-top:-5px">{{$post->title}} <span class="badge badge-warning" style="font-size: .7rem;">Deadline : {{ date('jS  F Y',strtotime($post->deadline))}}</span>
                                </h3>
                                <p class="mb-0 small">{{Str::limit($post->meta_description,100)}}</p>
                            </div>
                        </a>

                    </div>
                    @if(setting('list_ad') && (($loop->index+1) % 3) ==0)
                    <div class="article-card p-2 mb-2" style="width: 49%;">
                        {!! setting('list_ad') !!}
                    </div>
                    @endif
                    @endforeach


                </div>
            </div>
            <div class="col-lg-4">
                @livewire('sidebar-posts')
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

@endpush