@extends('layouts.app')

@section('content')
    <h1>Calendar</h1>
    <table class="table">
        <thead>
        <tr>
{{--            <th scope="col">Organizer</th>--}}
            <th scope="col">Subject</th>
            <th scope="col">Start</th>
{{--            <th scope="col">End</th>--}}
        </tr>
        </thead>
        <tbody>
        @isset($events)
            @foreach($events as $event)
                <tr>
                    <td>{{ $event['title'] }}</td>
                    <td>{{ $event['created_at'] }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
