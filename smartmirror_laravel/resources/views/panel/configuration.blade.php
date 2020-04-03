@extends('layouts.app')

@section('content')
    <section id="configuration">
        <!-- /col-md-4 -->
        @foreach($features as $feature)
        <div class="col-md-4 col-sm-4 mb">
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <h5>{{mb_strtoupper($feature->name)}}</h5>
                </div>
                <img class="icon" src="{{asset($feature->icon)}}" alt="todo"/>
                <p><input type="checkbox"  data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="info" data-offstyle="danger">
                </p>
                <div class="config">
                    <a href="#" class="link"> <i class="fa fa-cogs"></i> <span> KONFIGURUJ </span></a>
                </div>
            </div>
        </div>
        @endforeach
    </section>
@endsection
