@extends('layouts.app')

@section('content')
<h4 class="header-main">ZEWNĘTRZNE KONTA</h4>
<hr>
<div class="col-lg-12 main-chart">
    <div class="row mt">
        <!-- /col-md-4 -->
        <div class="col-md-4 col-sm-4 mb">
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <img class="loga" src="{{asset('img/Microsoft_logo_(2012).svg')}}" alt="Microsof"/>
                </div>
                @if($microsoft)
                    <h5>Witaj {{$microsoft['userName']}}</h5>
                    <a href="{{route('microsoft.signout')}}"><button class="btn btn-konta">WYLOGUJ <i class="fas fas fa-sign-in-alt pl-1"></i></button></a>
                    <footer class="des">Po wylogowaniu utracisz synchronizację z ToDo oraz kalendarzem Microsoft</footer>
                @else
                    <a href="{{route('microsoft.signin')}}"><button class="btn btn-konta">ZALOGUJ <i class="fas fas fa-sign-in-alt pl-1"></i></button></a>
                    <footer class="des">Logując się do konta Microsoft, uzyskasz synchronizację z todo oraz kalendarzem</footer>
                @endif
            </div>
        </div>
        <!-- /col-md-4-->
        <div class="col-md-4 col-sm-4 mb">
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <img class="loga" src="{{asset('img/Google_2015_logo.svg')}}" alt="Google"/>
                </div>
                <button class="btn btn-konta">ZALOGUJ <i class="fas fas fa-sign-in-alt pl-1"></i></button>
                <footer class="des">Logując się do konta Google, uzyskasz synchronizację z kalendarzem</footer>
            </div>
        </div>
        <!-- /col-md-4 -->
        <div class="col-md-4 col-sm-4 mb">
            <div class="darkblue-panel pn">
                <div class="coming">
                    <div class="darkblue-header">
                        <img class="loga" src="{{asset('img/Facebook_Logo_(2015)_light.svg')}}" alt="Facebook"/>
                    </div>
                    <p class="com">COMING SOON ...</p>
                    <button class="btn btn-konta" disabled>ZALOGUJ <i class="fas fas fa-sign-in-alt pl-1"></i></button>
                    <footer class="des" >Logowanie z facebookiem wkrótce</footer>
                </div>
            </div>
        </div>
        <!-- /col-md-4 -->
    </div>
</div>
@endsection
