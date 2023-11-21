@extends('frontend.layouts.frontend')
@section('title')
{{$title}}
@endsection
@push('css')

@endpush

@section('content')
<section class="section">
    <div class="container">
        <div class="row no-gutters-lg">
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