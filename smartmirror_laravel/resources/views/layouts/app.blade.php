<!DOCTYPE html>
<html>
<head>
    <title>BlackMirror - Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
          integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}?{{time()}}">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
        <a href="{{route('admin')}}" class="navbar-brand">BlackMirror - Panel</a>
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"--}}
{{--                aria-controls="navbarCollapse" aria-expanded="false"--}}
{{--                aria-label="{{ __('Toggle navigation') }}">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                @if(isset($microsoft) && count($microsoft))
                    <li class="nav-item" data-turbolinks="false">
                        <a href="{{route('tasks')}}" class="nav-link{{$_SERVER['REQUEST_URI'] == '/tasks' ? ' active' : ''}}">Calendar</a>
                    </li>
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
        </div>
        <ul class="navbar-nav ml-auto">
            @auth
                    <a class="text-white" id="force-refresh" href="{{route('forceSync')}}" style="margin-right: 15px">
                        <div class="btn btn-secondary" style="position: relative">
                            <i style="font-size:15px; opacity:0" class="fa">&#128472;</i>
                            <i class="fa refresh-icon">&#128472;</i>
                        </div>
                    </a>

                    <a class="text-white" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        <div class="btn btn-secondary">
                        <i style="font-size:15px" class="fa">&#xf011;</i>
                        </div>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>

            @endauth
        </ul>
    </div>
</nav>
<main role="main" class="container"style="margin-top: 80px">
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            <p class="mb-3">{{ session('error') }}</p>
            @if(session('errorDetail'))
                <pre class="alert-pre border bg-light p-2"><code>{{ session('errorDetail') }}</code></pre>
            @endif
        </div>
    @endif

    @yield('content')
</main>
    @yield('scripts-before')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    @yield('scripts-after')
</body>
</html>
