@extends('layouts.app')

@section('content')
    <section id="test-websockets">
        <h4 class="header-main">TESTOWANIE KOMUNIKACJI WEBSOCKET</h4>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <p>
                    Korzystając z poniższych przycisków można wywołać pobranie danych z zewnętrznego systemu
                    a następnie przekazanie ich za pomocą WebSocket do aplikacji klienckiej (lustra)
                    <a href="http://86.63.86.150/mirror/" target="_blank">(Podgląd LIVE dostępny tutaj)</a>.
                    <br/><br/>
                    Na potrzeby testowania komunikacji zarówno po stronie panelu jak i podglądu można podejrzeć przesyłane obiekty.
                    Tutaj będą one wyświetlane pod kafelkami z dostępnymi funkcjonalnościami natomiast na podglądzie można śledzić otrzymywane pakiety w konsoli developera (F12 > Console).
                    <br/><br/>
                    Należy jednak pamiętać, że oprócz danych wysyłanych manualnie, system w ustalonych odstępach czasu automatycznie przesyła dane,
                    więc ilość obiektów po stronie podglądu LIVE będzie znacznie większa.
                    <br/><br/>
                    <div class="text-center font-weight-bolder">
                        Aby zwiększyć wygodę osób testujących odpowiedź jest wyświetlana w postaci interaktywnej tablicy.<br>W realnej komunikacji jest to JSON.<br/><br/>
                        W razie jakichkolwiek problemów bądź pytań proszę o kontakt z członkami zespołu nr 3.
                    </div>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                @foreach($features as $feature)
                    <div class="col-4 py-3">
                        <div class="card">
                            <div class="card-header">
                                {{trans('features.'.$feature->name)}}
                            </div>
                            <div class="card-body text-center">
                                @if($feature->active)
                                    <a href="{{route('testWebsocketsData', [$feature])}}" data-name="{{trans('features.'.$feature->name)}}" class="btn btn-info init-ws" id="btnapi">Wywołaj</a>
                                @else
                                    <div style="padding: .375rem .75rem;font-size: 1rem;line-height: 1.5; border:1px solid transparent">
                                        Włącz usługę w panelu zarządzania
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-6">.col-6</div>
        </div>
        <div class="row">

        </div>
        <div class="row py-4">
            <div class="col-sm-12">
                <h2 class="title d-flex justify-content-between">
                    <span>Odpowiedź serwera</span>
                </h2>
                <h3 id="result-name"></h3>
                <div id="result"></div>
            </div>
        </div>
    </section>
    <div class="test-ws-loader">
        </div>
        <div class="position-relative w-100">
            <div class="loader">
                <div class="lds-ellipsis">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts-after')
<script>
    $(document).on('click', '.init-ws', function(e){
        e.preventDefault();
        let $el = $(this);
        $('.test-ws-loader').addClass('d-flex');
        $( "#result" ).html('');
        $( "#result-name" ).html('');

        $.get( $el.attr('href'), function( data ) {
            console.log(data);
            $( "#result" ).html( data );
            $( "#result-name" ).html( $el.data('name'));
            $('.test-ws-loader').removeClass('d-flex');
        });
    });
</script>
@endsection
