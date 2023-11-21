@extends('frontend.layouts.frontend')
@section('meta_title',$title)
@section('title',$blog->title)
@section('meta_keyword',$blog->meta_keywords)
@section('meta_description',Str::limit($blog->meta_description,60))
@section('meta_og_title',$title)
@section('meta_og_description',Str::limit($blog->meta_description,60))




@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <article>
                    @if(isset($blog->youtube_link))
                    <div class="youtube-link">
                        {!! $blog->youtube_link !!}
                    </div>
                    @endif
                    @if(isset($blog->image))
                    <div class="youtube-link">
                        <img class="w-100 h-100" src="{{$blog->image}}" alt="">
                    </div>
                    @endif
                    <h1 class="my-3">{{$blog->title}}</h1>
                    <ul class="post-meta mb-4">
                        @php
                        $categories = $blog->categories->toArray();
                        @endphp
                        @foreach ($categories as $category )
                        <li class="">
                            <a href="{{route('blog-by-category',['slug'=>$category['slug']])}}"> {{$category['name']}}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="content text-left">
                        {!! $blog->description !!}
                    </div>
                </article>

            </div>
            <div class="col-lg-4">
                @livewire('sidebar-blogs')
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

@endpush