<!-- Head -->

<head>
  <meta charset="utf-8">
  <title itemprop="name">@yield('meta_title',setting('meta_site_name'))</title>
  <!-- meta  -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
  <meta name="title" content="@yield('title',setting('meta_site_name'))">
  <meta name="keywords" content="@yield('meta_keyword',setting('meta_keyword'))">
  <meta name="description" content="@yield('meta_description',setting('meta_description'))">
  <meta name="author" content="Jobghor">
  <meta property="og:type" content="article" />
  <meta property="article:publisher" content="{{setting('meta_publisher') ?? 'Jobghor.com'}}" />
  <meta property="og:title" content="@yield('meta_og_title',setting('meta_site_name'))"/>
  <meta property="og:description" content="@yield('meta_og_description',setting('meta_description'))"/>
  <meta property="og:site_name" content="{{setting('meta_site_name')}}" />
  {!! setting('google_console') !!}
  {!! setting('adsense_script') !!}

  <link rel="canonical" href="{{url()->current()}}" />


  <link rel="shortcut icon" href="{{asset('images/'.setting('site_logo'))}}" type="image/x-icon">
  <link rel="icon" href="{{asset('images/'.setting('site_logo'))}}" type="image/x-icon">
  <!-- # Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- font-awesome -->
  <link rel="stylesheet" href="{{ asset('assets/modules/@fortawesome/fontawesome-free/css/all.min.css') }}">
  <!-- # CSS Plugins -->

  <link rel="stylesheet" href="{{ asset('frontend/asset/plugins/bootstrap/bootstrap.min.css')}}">

  <!-- # Main Style Sheet -->
  <link rel="stylesheet" href="{{ asset('frontend/asset/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/asset/css/custom.css')}}">
  @stack('css')
  {!! setting('google_analytics') !!}
</head>
<!-- Head -->