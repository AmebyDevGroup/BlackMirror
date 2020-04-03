<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Menu"></div>
    </div>
    <!--logo start-->
    <a href="{{route('admin')}}" class="logo"><b>Black<span>Mirror</span></b></a>
    <!--logo end-->
    <div class="top-menu">
        @auth
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">WYLOGUJ</a></li>
            </ul>

            {{-- Ukryty formularz - NIE USUWAC --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                @csrf
            </form>
        @endauth
    </div>
</header>
