@extends('frontend.layouts.frontend')
@section('meta_title',$title)
@section('title',$post->title)
@section('meta_keyword',$post->meta_keywords)    
@section('meta_description',Str::limit($post->meta_description,60))    
@section('meta_og_title',$title)    
@section('meta_og_description',Str::limit($post->meta_description,60)) 

@section('content')
<section class="section">
    <div class="container">
        <div class="row show-post">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <article>
                    <div class="show-heading">
                        <h1>{{ $post->title }}</h1>
                    </div>
                    <div class="d-flex justify-content-between flex-wrap">
                        @if($post->categories)
                        <ul class="post-meta mb-2 mt-4">
                            @foreach($post->categories as $post_category)
                            <li> <a href="{{route('post-by-category',['slug'=>$post_category->slug])}}">{{$post_category->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        <ul class="deadline mb-2 mt-4 ">
                            <li>
                                <span class="badge badge-warning"> Deadline : {{ date('d M, Y',strtotime($post->deadline)) }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="content text-left">
                        {!! $post->description !!}
                    </div> 
                    @if(!is_null($post->apply_link))
                    <div>
                        <a target="_blank" href="{{ $post->apply_link }}" class="btn btn-success">Apply</a>
                    </div>
                    @endif
                    @if(isset($post->image))
                    <div class="mt-4">
                        <img class="w-100" src="{{$post->image}}" alt="">
                    </div>
                    @endif
                </article>
                
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