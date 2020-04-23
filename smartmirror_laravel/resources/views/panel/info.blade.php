@extends('layouts.app')
<style>
    .logo {
        color: #4ECDC4;
    }
</style>
@section('content')
    <h4 class="header-main">INFORMACJE O PROJEKCIE</h4>
    <hr>
    <div class="dbp-p">
        <div class="container darkblue-panel p-md-5">
            <p>Projekt <b>Black<span class="logo">Mirror</span></b> to uczelniany projekt inteligentnego lustra
                stworzony przez pasjonatów informatyki i nowych technologii. Zakłada on rozwój  lustra, które już teraz zanjduje zastosowanie w domu jednego członka
                sespołu. </p>
            <p>Inteligentne lustro pokazuje czas, warunki atmosferyczne (stopnie Celsjusza, wilgotność powietrza, ciśnienie
                atmosferyczne, zachmurzenie, prędkość wiatru, jakość powietrza), zaplanowane nadchodzące wydarzenia oraz
                bieżące zadanie do wykonania - organizer „to do list”. Mimochodem technologia zmieniła wszystkie aspekty
                naszego życia. W każdym domu, na każdym biurku i w każdej dłoni można zobaczyć ekran plazmowy, monitor
                lub smartfon - czarne lustro odbijające codzienność XXI wieku. Wszystko to po to aby ułatwić życie, bo
                przecież o to właśnie chodzi.</p>



            <div class="row">
                <table class=" white-text ">

                    <h6>Planowany rozwój lustra</h6>
                    <tbody>
                    <tr>
                        <td>Wersja prototypowa</td>
                        <td>v0.1 wydana 11.01.2020</td>
                    </tr>
                    <tr>
                        <td>Wersja prototypowa</td>
                        <td>v0.2 planowana data wydania 25.04.2020</td>
                    </tr>
                    <tr>
                        <td>Wersja prototypowa</td>
                        <td>v0.3 planowana data wydania 06.06.2020</td>
                    </tr>
                    <tr>
                        <td>Wersja prototypowa</td>
                        <td>projekt będzie rozwijany na potrzeby pracy Inżynierskiej</td>
                    </tr>


                    </tbody>
                </table>


            </div>
        </div>
@endsection
