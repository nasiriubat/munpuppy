<div>

    <div class="widget-blocks">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h2 class="section-title mb-3">Categories</h2>
                    <div class="widget-body">
                        <ul class="widget-list">
                            @foreach($sidebarCategories as $sideCategory)
                            <li><a href="{{route('blog-by-category',['slug'=>$sideCategory->slug])}}">{{$sideCategory->name}}<span class="ml-auto">({{$sideCategory->blogs_count}})</span></a>
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
                            @foreach($sidebar_blogs as $sidebar_blog)
                            <a class="media align-items-center" href="{{route('blog-details',['slug'=>$sidebar_blog->slug])}}">
                                <div class="media-body ml-3">
                                    <h3 style="margin-top:-5px">{{$sidebar_blog->title}}</h3>
                                    <p class="mb-0 small">{{Str::limit($sidebar_blog->meta_description,100)}}</p>
                                </div>
                            </a>
                            @if(setting('list_ad') && (($loop->index+1) % 3) ==0)
                            <div class="p-2 mb-2" style="width: 100%;">
                                {!! setting('list_ad') !!}
                            </div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>