@extends('layouts.app')
@section('title', 'Timeline')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/timeline.min.css')}}">
@endsection
@section('content')

    <ul class="timeline">
        <li class="event">
            <a target="_blank" href="https://www.totoprayogo.com/#" data-date="21 March, 2014">New Web Design</a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et
                elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales
                vehicula....</p>
        </li>
        <li class="event">
            <a href="#" data-date="4 June, 2014">21 000 Job Seekers</a>
            <p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo
                accumsan, sed semper nisi sollicitudin...</p>
        </li>
        <li class="event">
            <a href="#" data-date="1 April, 2014">Awesome Employers</a>
            <p>Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae,
                mollis pharetra velit. Sed nec tempor nibh...</p>
        </li>
    </ul>


@endsection
