<header class="navigation">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light px-0">
      <a class="navbar-brand order-1 py-0" href="{{route('/')}}">
        <img loading="prelaod" decoding="async" class="img-fluid" src="{{site_logo()}}" alt="Reporter Hugo">
      </a>
      <div class="navbar-actions order-3 ml-0 ml-md-4">
        <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation"> <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
        <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
          <li class="nav-item"> <a class="nav-link" href="{{route('all-blogs')}}">Blogs</a>
          </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Jobs
            </a>
            <div class="dropdown-menu">
              @foreach($all_categories as $category)
              <a class="dropdown-item" href="{{route('post-by-category',['slug'=>$category->slug])}}">{{$category->name}}</a>
              @endforeach
            </div>
          </li>
          <li class="nav-item"> <a class="nav-link" href="contact.html">Contact</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>