@extends('layouts.app')
<style>


</style>
@section('content')
    <h4 class="header-main">POMOC</h4>
    <hr>
    <div class="dbp-p container main-c">

        <div class="card teal lighten-2">
            <div class="card-content">

                <ul data-method="GET" class="stepper vertical">
                    <li class="step active">
                        <div class="step-title waves-effect waves-dark">Specyfikacja</div>
                        <div class="step-content">
                            <div class="row">


                            </div>
                            <div class="step-actions">
                                <button class="waves-effect waves-dark btn blue-grey lighten-2 next-step"
                                >Continue
                                </button>
                            </div>
                        </div>
                    </li>
                    <li class="step">
                        <div class="step-title waves-effect waves-dark">Uruchomienie</div>
                        <div class="step-content">
                            <div class="row">
                                <div class="card-image col s6">
                                    <img  src="{{asset('img/wl.png')}}" style="width: 50%" alt="Google"/>
                                </div>
                                <div class="col s6">
                                    <ul>
                                        <li>1.Aby uruchomić urządzenie niezbędne jest zapewnienie źródła zalsilania urządzenia.</li>
                                        <li>2.Należy włączyć lustro przyciskiem, który znajduje się przy dolnej krawędzi lustr. Patrz rysunek.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="step-actions">
                                <button class="waves-effect waves-dark btn blue-grey lighten-2 next-step">CONTINUE</button>
                                <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                            </div>
                        </div>
                    </li>
                    <li class="step">
                        <div class="step-title waves-effect waves-dark">Step 2</div>
                        <div class="step-content">
                            <div class="row">
                                <div class="input-field col s12">

                                </div>
                            </div>
                            <div class="step-actions">
                                <button class="waves-effect waves-dark btn blue next-step">CONTINUE</button>
                                <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                            </div>
                        </div>
                    </li>
                    <li class="step">
                        <div class="step-title waves-effect waves-dark">Step 2</div>
                        <div class="step-content">
                            <div class="row">
                                <div class="input-field col s12">

                                </div>
                            </div>
                            <div class="step-actions">
                                <button class="waves-effect waves-dark btn blue next-step">CONTINUE</button>
                                <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                            </div>
                        </div>
                    </li>
                    <li class="step">
                        <div class="step-title waves-effect waves-dark">Step 2</div>
                        <div class="step-content">
                            <div class="row">
                                <div class="input-field col s12">

                                </div>
                            </div>
                            <div class="step-actions">
                                <button class="waves-effect waves-dark btn blue next-step">CONTINUE</button>
                                <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                            </div>
                        </div>
                    </li>
                    <li class="step">
                        <div class="step-title waves-effect waves-dark">Step 2</div>
                        <div class="step-content">
                            <div class="row">
                                <div class="input-field col s12">

                                </div>
                            </div>
                            <div class="step-actions">
                                <button class="waves-effect waves-dark btn blue next-step">CONTINUE</button>
                                <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                            </div>
                        </div>
                    </li>
                    <li class="step">
                        <div class="step-title waves-effect waves-dark">Callback</div>
                        <div class="step-content">
                            End!!!!!
                            <div class="step-actions">
                                <button class="waves-effect waves-dark btn blue next-step"
                                        data-feedback="noThing">ENDLESS CALLBACK!
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>




    </div>


@endsection
