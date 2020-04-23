@extends('layouts.app')
<style>

    /*.step-content {*/
    /*      padding: 5px 0 0 5px !important;*/
    /*  }*/
    .card {
        width: 100% !important;
        margin: 0 !important;

    }

    @media (min-width: 300px) {
        .card {
            height: 100% !important;
        }

        ul {
            height: 100%;
            overflow: hidden !important;
        }

        form {
            height: 100%;
            overflow: hidden !important;
        }
    }

    @media (min-width: 1000px) {
        .card {
            height: 70vh !important;
        }

        ul {
            height: 100%;
            overflow: hidden !important;
        }

        form {
            height: 100%;
            overflow: hidden !important;
        }

    }

    @media (max-width: 1400px) {
        .card {
            height: 80vh !important;
        }

        ul {
            height: 100%;
            overflow: hidden !important;
        }

        form {
            height: 100%;
            overflow: hidden !important;
        }

    }


    /*.card-image {*/
    /*    height: 80%;*/
    /*}*/


</style>
@section('content')
    <h4 class="header-main ">POMOC</h4>
    <hr>

    <div class="card teal lighten-2">

        <ul data-method="GET" class="stepper horizontal">
            {{--                        SPECYFIKACJA--}}
            <li class="step active">
                <div class="step-title waves-effect waves-dark">Specyfikacja</div>

                <div class="step-content">
                    <div class="step-actions">
                        <button class="waves-effect waves-dark btn  lighten-2 next-step"
                        >Continue
                        </button>
                    </div>
                    <div class="row">
                        <table class=" white-text ">


                            <tbody>
                            <tr>
                                <td>Rozdzielczość</td>
                                <td>1680 x 1050</td>
                            </tr>
                            <tr>
                                <td>Czas reakcji matrycy</td>
                                <td>2 ms</td>
                            </tr>
                            <tr>
                                <td>Złącza</td>
                                <td>DVI x 1, VGA x 1</td>
                            </tr>
                            <tr>
                                <td>Oprawa</td>
                                <td>Drewniana rama</td>
                            </tr>
                            <tr>
                                <td>Mikrokomputer</td>
                                <td>Raspberry 3B+</td>
                            </tr>
                            <tr>
                                <td>Kąt widzenia w pionie / w poziomie</td>
                                <td>170 stopni / 170 stopni</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </li>
            {{--                        URUCHOMIENIE--}}
            <li class="step">
                <div class="step-title waves-effect waves-dark">Uruchomienie</div>
                <div class="step-content">
                    <div class="step-actions">
                        <button class="waves-effect waves-dark btn  lighten-2 next-step">CONTINUE
                        </button>
                        <button class="waves-effect waves-dark btn previous-step">BACK</button>
                    </div>
                    <div class="row">
                        <div class="card-image col-6">
                            <img src="{{asset('img/wl.png')}}" style="width: 55%" alt="Google"/>
                        </div>
                        <div class="col-6">
                            <ul>
                                <li>1.Aby uruchomić urządzenie niezbędne jest zapewnienie źródła
                                    zalsilania urządzenia.
                                </li>
                                <li>2.Należy włączyć lustro przyciskiem, który znajduje się przy dolnej
                                    krawędzi lustra. Patrz rysunek.
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </li>
            {{--                        WIFI--}}
            <li class="step">
                <div class="step-title waves-effect waves-dark">Połączenie WiFi</div>
                <div class="step-content">
                    <div class="step-actions">
                        <button class="waves-effect waves-dark btn  lighten-2 next-step">CONTINUE
                        </button>
                        <button class="waves-effect waves-dark btn previous-step">BACK</button>
                    </div>

                    <div class="row">
                        <div class="card-image col-5">
                            <img src="{{asset('img/overview.gif')}}" style="width: 45%" alt="Google"/>
                        </div>
                        <div class="col-7">
                            <ul>
                                <li>1.Podłącz urządzenie do swojego WiFi
                                </li>
                                <li>2.Pobierz aplikację BerryLan (linki dostepne poniżej), a następnie postępuj zgodnie
                                    z instrukcją
                                    aplikacji. Patrz rysunek.
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="https://apps.apple.com/us/app/berrylan/id1436156018">
                                                <img src="{{asset('img/app.png')}}" alt="App-Store" style="width: 65%"></a>
                                        </div>
                                        <div class="col-6"><a
                                                href="https://play.google.com/store/apps/details?id=io.guh.berrylan">
                                                <img src="{{asset('img/google.png')}}" alt="GooglePlay"
                                                     style="width: 65%"></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </li>
            {{--KORZYSTANIE Z NIEKTÓRYCH FUNKCJI--}}
            <li class="step">
                <div class="step-title waves-effect waves-dark">Korzystanie z niektórych funkcji</div>
                <div class="step-content">
                    <div class="step-actions">
                        <button class="waves-effect waves-dark btn  lighten-2 next-step">CONTINUE
                        </button>
                        <button class="waves-effect waves-dark btn previous-step">BACK</button>
                    </div>
                    <div class="row">
                        <div class="card-image col s6">
                            <img src="{{asset('img/k-zewn.png')}}" style="width: 70%" alt="Google"/>
                        </div>
                        <div class="col s6">

                            <ul>
                                <li>1.Do korzystania z niektórzych funkcji urządzenia należy zalogować się na jedno
                                    ze swoich kont Microsoft lub Google
                                </li>
                                <li>2.Jeśli uzytkownik nie posiada konta, w ten czas konieczne jest jego
                                    założenie poprzez strony: <a
                                        href="https://signup.live.com/signup?wa=wsignin1.0&rpsnv=13&rver=7.3.6963.0&wp=MBI_SSL&wreply=https%3a%2f%2fwww.microsoft.com%2fpl-pl%3f%26ef_id%3dCjwKCAjwkPX0BRBKEiwA7THxiCaMi9lterJX1iLNWF4AD-azndjiylwhlpIyHxwscBAN5vSJk1r5pRoCZ3gQAvD_BwE%3aG%3as%26s_kwcid%3dAL!4249!3!232284842847!e!!g!!microsoft%26ef_id%3dCjwKCAjwkPX0BRBKEiwA7THxiCaMi9lterJX1iLNWF4AD-azndjiylwhlpIyHxwscBAN5vSJk1r5pRoCZ3gQAvD_BwE%3aG%3as%26OCID%3dAID2000001_SEM_CjwKCAjwkPX0BRBKEiwA7THxiCaMi9lterJX1iLNWF4AD-azndjiylwhlpIyHxwscBAN5vSJk1r5pRoCZ3gQAvD_BwE%3aG%3as&id=74335&aadredir=1&contextid=7781B38E60557056&bk=1587401469&uiflavor=web&lic=1&mkt=PL-PL&lc=1045&uaid=0fc534b992a344e7e499950f86991172">
                                        Microsoft</a> lub <a
                                        href="https://accounts.google.com/signup/v2/webcreateaccount?flowName=GlifWebSignIn&flowEntry=SignUp">Google</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </li>
            {{--MENU I STEROWANIE--}}
            <li class="step">
                <div class="step-title waves-effect waves-dark">Menu i sterowanie</div>
                <div class="step-content">
                    <div class="step-actions">
                        <button class="waves-effect waves-dark btn  lighten-2 next-step">CONTINUE
                        </button>
                        <button class="waves-effect waves-dark btn previous-step">BACK</button>
                    </div>
                    <div class="row">

                        <div class="card-image col s6">
                            <img src="{{asset('img/panel2.png')}}" style="width: 100%" alt="Google"/>
                        </div>

                        <div class="col s6">
                            <ul>

                                <li>1. "Elementy na lustrze" - Dostęp do sterowania poszczególnymi elementami lustra.
                                </li>
                                <li>2. "Zewnętrzne konta" - Logowanie do kont w celu synchornizacji z zewnętrzynch
                                    aplikacji.
                                </li>
                                <li>3. "Test API" - Informacje dla programistów z wywoływanych API.
                                </li>
                                <li>4. "Instrukcja użytkownia" - zasady użytkowania z urządzenia.
                                </li>
                                <li>5. "Informacje" - Informacje ogólne dotyczące BLACKMIRROR.
                                </li>
                                <li>6."Dziennik zmina" - Zawiera historię zmian wprowadzonych przez zespół BLACKMIRROR.
                                </li>
                                <li>7-8.Przyciski "ON/OFF" służą do aktywacji lub dezaktywacji wyświetlania
                                    poszczególnych elementów na urządzeniu.
                                </li>
                                <li>9."Konfiguruj" - przycisk do dodania własnych źródeł konfiguracyjnych i
                                    zatwierdzania zmian.
                                </li>
                                <li>10."COMMING SOON..." - oznaczenie elementów, które są w trakcie implementacji.</li>
                            </ul>


                        </div>

                    </div>
                </div>
            </li>

            <li class="step">
                <div class="step-title waves-effect waves-dark">Elementy</div>
                <div class="step-content">
                    <div class="step-actions">
                        <button class="waves-effect waves-dark btn  lighten-2 next-step">CONTINUE
                        </button>
                        <button class="waves-effect waves-dark btn previous-step">BACK</button>
                    </div>
                    <div class="row">

                        <div class="card-image col s6">
                            <img src="{{asset('img/elementy1.png')}}" style="width: 100%" alt="Google"/>
                        </div>
                        <div class="col s6">
                            <ul>
                                <li>1."STATYSTYKI COVID-19" - Wyświetla aktualne statystyki pandemi w Polsce i na
                                    świecie.
                                </li>
                                <li>2."WIADOMOŚCI" - pozwala na wybór lub dodanie kanału RSS, z którego mają zostac
                                    pobrane dane, a następnie wyświetlone na ekranie.
                                </li>
                                <li>3."JAKOŚĆ POWIETRZA" - pozwala na wybranie najbliższego czujnika z Twojej okolicy w
                                    celu wyświetlenia jakości powietrza.
                                </li>
                                <li>4."POGODA" - pozwala na wybranie miejscowośc dla, której mają zostać wyświetlane
                                    dane pogodowe.
                                </li>
                                <li>5."LISTA ZADAŃ" - wyświetla zadań z Microsoft Todo. (Niezbędne jest zalogowanie się
                                    do konta. Patrz punkt 4)
                                </li>
                                <li>6."KALENDARZ" - wyświetla zbliżające się wydarzenia w oparciu o synchronizację z
                                    Microsoft lub Google.(Niezbędne jest zalogowanie się do konta. Patrz punkt 4)
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </li>

            <li class="step">
                <div class="step-title waves-effect waves-dark">KONIEC</div>
                <div class="step-content">
                    <div class="step-actions">

                        <button class="waves-effect waves-dark btn previous-step">BACK</button>
                    </div>
                    <div class="row ">
                        <div class="col-12 center-align">
                        <h5>BRAWO! TWOJE LUSTRO JEST GOTOWE DO DZIAŁANIA.</h5>
                        <h6><a href="http://86.63.86.150/mirror/" target="_blank">(Podgląd LIVE dostępny tutaj)</a></h6>
                        </div>
                    </div>

                </div>
            </li>


        </ul>
    </div>



@endsection
