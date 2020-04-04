@extends('layouts.app')

@section('content')
    <section id="configuration">
        <div class="row">
            @foreach($features as $feature)
                <div class="col-md-4 col-sm-4 mb">
                    <div class="darkblue-panel pn">
                        <div class="darkblue-header">
                            <h5>{{mb_strtoupper($feature->name)}}</h5>
                        </div>
                        <img class="icon" src="{{asset($feature->icon)}}" alt="todo"/>
                        <p>
                            @php
                                $checked = '';
                                if($feature->config && $feature->config->active == 1){
                                    $checked = 'checked';
                                }
                            @endphp
                            <input type="checkbox" class="set-feature-active" data-toggle="toggle" data-on="ON"
                                   data-off="OFF"
                                   data-onstyle="info" data-offstyle="danger"
                                   data-href="{{route('configuration.setActive', [$feature])}}" value="1" {{$checked}}>
                        </p>
                        <div class="config">
                            <a href="{{route('configuration.getConfigurationForm', [$feature])}}" class="link start_configuration">
                                <i class="fa fa-cogs"></i> <span> KONFIGURUJ </span>
                            </a>
                        </div>
                        <div class="feature-configuration">
                            aaaaa
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
