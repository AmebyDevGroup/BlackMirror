<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BlackMirror - projekt inteligentnego lustra</title>

    <!-- Favicons -->
    <link href="{{asset('img/favicon.ico')}}" rel="icon">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/bootstrap/css/bootstrap4-toggle.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet">
    <!--external burger menu-->

</head>

<body>
    <section id="container">
    <!--header start-->
        @include('partials.header')
    <!--header end-->
    <!--sidebar start-->
        @include('partials.sidebar')
    <!--sidebar end-->

    <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12 main-chart">
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                <p class="mb-3">{{ session('error') }}</p>
                                @if(session('errorDetail'))
                                    <pre class="alert-pre border bg-light p-2"><code>{{ session('errorDetail') }}</code></pre>
                                @endif
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
                <!-- /row -->
            </section>
        </section>
    <!--main content end-->
    <!--footer start-->
        @include('partials.footer')
    <!--footer end-->
    </section>
@yield('scripts-before')
    <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('lib/bootstrap/js/bootstrap4-toggle.js')}}"></script>
    <script src="{{asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('lib/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{asset('lib/jquery.sparkline.js')}}"></script>
    <!--common script for all pages-->
    <script src="{{asset('lib/common-scripts.js')}}"></script>
    <script>
        var m = $(".tooltips");

        m.addClass("fa-times");

        m.on("click", function () {
            if (m.hasClass("fa-times")) {
                m.removeClass("fa-times").addClass("fa-bars");
            } else {
                m.removeClass("fa-bars").addClass("fa-times");
            }
        });

    </script>
@yield('scripts-after')
</body>
</html>
