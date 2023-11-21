
    <div class="widget-blocks">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h2 class="section-title mb-3">Categories</h2>
                    <div class="widget-body">
                        <ul class="widget-list">
                            @foreach($cattegories as $sideCategory)
                            <li><a href="{{route('post-by-category',['slug'=>$sideCategory->slug])}}">{{$sideCategory->name}}<span class="ml-auto">({{$sideCategory->posts_count}})</span></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h2 class="section-title mb-3">{{$sidebar_title}}</h2>
                    <div class="widget-body">
                        <div class="widget-list">
                            @foreach($sidebar_posts as $sidebar_post)
                            @if($sidebar_title == 'Internships')
                            <a class="media align-items-center" href="{{route('post-details',['slug'=>$sidebar_post->slug])}}">
                                @else
                                <a class="media align-items-center" href="{{route('blog-details',['slug'=>$sidebar_post->slug])}}">
                                    @endif
                                    <div class="media-body ml-3">
                                        <h3 style="margin-top:-5px">{{$sidebar_post->title}}</h3>
                                        <span class="badge badge-warning" style="font-size: .7rem;">Deadline : {{ date('jS  F Y',strtotime($sidebar_post->deadline))}}</span>
                                        <p class="mb-0 small">{{Str::limit($sidebar_post->meta_description,100)}}</p>
                                    </div>
                                </a>
                                @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>