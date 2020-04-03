<!DOCTYPE html>
<html>
<head>
    <title>BlackMirror - Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
          integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}?{{time()}}">
</head>

<body>
<main role="main" class="auth">
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
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="{{asset('js/main.js')}}"></script>
@yield('scripts-after')
</body>
</html>
