<header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars fa-times tooltips" data-original-title="Menu"></div>
        </div>
    <!--logo start-->
    <a href="{{route('admin')}}" class="logo"><b>Black<span>Mirror</span></b></a>
    <!--logo end-->
    @auth
        <div class="d-flex flex-row-reverse bd-highlight">
            <a class="logout pull-right" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">WYLOGUJ</a>
            {{-- Ukryty formularz - NIE USUWAC --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                @csrf
            </form>
            @endauth
        </div>
</header>

