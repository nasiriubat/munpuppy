@extends('frontend.layouts.frontend')
@section('meta_title')
Blogs
@endsection
@section('title')
Blogs
@endsection
@push('css')

@endpush

@section('content')
<section class="section">
    <div class="container">
        <div class="row no-gutters-lg">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="{{route('blog-details',['slug'=>$blog->slug])}}">
                                <h2>{{$blog->title}}</h2>
                                <p class="card-text">{{Str::limit($blog->meta_description,100)}}</p>
                            </a>
                        </article>
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
                @livewire('sidebar-blogs')

            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

@endpush