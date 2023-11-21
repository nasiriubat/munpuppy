<div class="breaking_news">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
        <div class="acme-news-ticker">
          <div class="acme-news-ticker-label">ব্রেকিং নিউজ</div>
          <div class="acme-news-ticker-box">
            <ul class="my-news-ticker">
              @if(!blank($breakingnewse))
              @foreach($breakingnewse as $breakingnews)
              <li><i class="fas fa-sm fa-fw me-10px fa-hand-point-right" style="color:#213165;"></i><a href="{{ !blank($breakingnews->post_id) ? $breakingnews->post->slug : '#'  }}"> {{ $breakingnews->title }}</a></li>
              @endforeach
              @endif
            </ul>
          </div>
          <div class="acme-news-ticker-controls acme-news-ticker-horizontal-controls">
            <button class="acme-news-ticker-pause"></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- other menu  -->

<div class="popular">
  <div class="container">
  @if(!blank($allmenus))

    <div class="row">
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 col-12"> <strong>অন্যান্য মেনু</strong> </div>
      <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12 col-12">
        <div class="tag">
          <ul>
          @foreach($allmenus as $allmenu)
          <li><a href="{{ $allmenu->slug }}">{{ $allmenu->name }}</a></li>
          @endforeach
          </ul>
        </div>
      </div>
    </div>

  @endif
  </div>
</div>
