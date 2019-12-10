@extends('layouts.app')

@section('content')
    <section id="config">
        <form method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title d-flex justify-content-between">
                        <span>Konfiguracja</span>
                        <button class="btn btn-dark" type="submit">Zapisz</button>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex flex-wrap align-items-stretch item">
                        <label class="switch">
                            <input type="hidden" name="config[tasks]" value="0">
                            <input type="checkbox" name="config[tasks]" value="1" @if($config['tasks']['enabled']??false) checked @endif>
                            <span class="slider"></span>
                        </label>
                        <span class="object_title">Lista zadań</span>
                        <span class="flex-grow-1"></span>
                        <div class="main-select">
                            <select class="selectpicker" name="tasks[provider]">
                                <option value="microsoft" data-value="{{route('taskFolders',['provider'=>'microsoft'])}}"
                                    @if($config['tasks']['provider'] == 'microsoft') selected @endif>Microsoft To-Do</option>
                                <option value="google" data-value="{{route('taskFolders',['provider'=>'google'])}}"
                                    @if($config['tasks']['provider'] == 'google') selected @endif>Google Tasks</option>
                            </select>
                        </div>
                        <div class="second-select">
                            <select class="selectpicker" name="tasks[directory]" disabled>
                                <option>Wybierz źródło</option>
                            </select>
                            <div class="loader tasks">
                                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex flex-wrap align-items-stretch item">
                        <label class="switch">
                            <input type="hidden" name="config[calendar]" value="0">
                            <input type="checkbox" name="config[calendar]" value="1" @if($config['calendar']['enabled']??false) checked @endif>
                            <span class="slider"></span>
                        </label>
                        <span class="object_title">Kalendarz</span>
                        <span class="flex-grow-1"></span>
                        <div class="main-select">
                            <select class="selectpicker" name="calendar[provider]">
                                <option value="microsoft" >Microsoft Calendar</option>
                                <option value="google">Google Calendar</option>
                            </select>
                        </div>
                        <div class="second-select">
                            <select class="selectpicker" disabled>
                                <option>Wybierz źródło</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex flex-wrap align-items-stretch item">
                        <label class="switch">
                            <input type="hidden" name="config[news]" value="0">
                            <input type="checkbox" name="config[news]" value="1" @if($config['news']['enabled']??false) checked @endif>
                            <span class="slider"></span>
                        </label>
                        <span class="object_title">Wiadomości</span>
                        <span class="flex-grow-1"></span>
                        <div class="main-select">
                            <select class="selectpicker" name="rss">
                                <option value="rss1">Wiadomości 1</option>
                                <option value="rss2">Wiadomości 2</option>
                                <option value="-1">Inne</option>
                            </select>
                        </div>
                        <div class="second-select">
                            <input type="text" class="form-control rss-input" name="rss" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex flex-wrap align-items-stretch item">
                        <label class="switch">
                            <input type="hidden" name="config[weather]" value="0">
                            <input type="checkbox" name="config[weather]" value="1" @if($config['weather']['enabled']??false) checked @endif>
                            <span class="slider"></span>
                        </label>
                        <span class="object_title">Pogoda</span>
                        <span class="flex-grow-1"></span>
                        <div class="main-select">
                            <select class="selectpicker" data-live-search="true" name="weather[city]">
                                @foreach($weather_cities as $city)
                                    <option value="{{$city['id']}}" @if($config['weather']['city'] == $city['ext_id']) selected @endif>{{$city['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex flex-wrap align-items-stretch item">
                        <label class="switch">
                            <input type="hidden" name="config[air]" value="0">
                            <input type="checkbox" name="config[air]" value="1" @if($config['air']['enabled']??false) checked @endif>
                            <span class="slider"></span>
                        </label>
                        <span class="object_title">AirQuality</span>
                        <span class="flex-grow-1"></span>
                        <div class="main-select">
                            <select class="selectpicker" name="air[station]" data-url="{{route('air.getStations')}}" data-live-search="true" disabled>
                                <option>Wybierz miasto</option>
                            </select>
                            <div class="loader air">
                                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>


    <div class="row bg-dark py-5">
        <div class="col-sm-6">
            <div class="jumbotron">
                <h1>Microsoft</h1>
                @if(isset($microsoft) && count($microsoft))
                    <h4>Welcome {{ $microsoft['userName'] }}!</h4>
                    <a href="{{route('microsoft.signout')}}" class="btn btn-primary btn-large">Wyloguj</a>
                @else
                    <h4>Zaloguj się</h4>
                    <a href="{{route('microsoft.signin')}}" class="btn btn-primary btn-large">Zaloguj</a>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="jumbotron">
                <h1>Google</h1>
                @if(isset($google) && count($google))
                    <h4>Welcome {{ $google['userName'] }}!</h4>
                    <a href="{{route('microsoft.signout')}}" class="btn btn-primary btn-large">Wyloguj</a>
                @else
                    <h4>Zaloguj się</h4>
                    <a href="{{route('microsoft.signin')}}" class="btn btn-primary btn-large">Zaloguj</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts-before')
    <script>
        let config = {
            'tasks': {
                'provider': '{{$config['tasks']['provider']}}',
                'directory': '{{$config['tasks']['directory']}}'
            },
            'calendar': {
                'provider': '{{$config['calendar']['provider']}}',
                'directory': '{{$config['calendar']['directory']}}'
            },
            'air': {
                'station': '{{$config['air']['station']}}',
            }
        }
    </script>
@endsection

@section('scripts-after')

@endsection
