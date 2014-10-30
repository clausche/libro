<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#" 
      <!-- xmlns:fb="https://www.facebook.com/2008/fbml" -->
      >
    <head>
        @section('description', trans('layouts.meta_description'))
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:title" content="" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <meta property="og:site_name" content="" />
        <meta property="og:description" content="@yield('description')" />
        <meta name="description" content="@yield('description')">
        <meta name="author" content="{{ trans('layouts.meta_author') }}">
        <title>
		@yield('title') 
		| 
		{{ trans('layouts.site_title') }}
	</title>
        <link rel="stylesheet" href="{{ asset('css/laratricks.min.css') }}">
        <link href="{{ asset('css/font-awesome.css') }} " rel="stylesheet">
        @yield('styles')
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="{{ asset('js/html5shiv.js') }} "></script>
        <script src="{{ asset('js/respond.js') }}"></script>
        <![endif]-->
    </head>

    <body>
        <div id="wrap">
            @include('partials.navigation')
            @yield('content')
        </div>

        @include('partials.footer')

        
        <script src="{{ asset('js/jquery.min.js') }} "></script>
        <script src="{{ asset('js/bootstrap.min.js') }} "></script>
        @yield('scripts')
        <script type="text/javascript">
            var disqus_shortname = '{{ Config::get("config.disqus_shortname") }}';
            (function(){var e=document.createElement("script");e.async=true;e.type="text/javascript";e.src="//"+disqus_shortname+".disqus.com/count.js";(document.getElementsByTagName("HEAD")[0]||document.getElementsByTagName("BODY")[0]).appendChild(e)})()
        </script>
    </body>
</html>
