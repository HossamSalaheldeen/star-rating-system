@extends('layout.app', ['title' => 'Create '  . Str::singular(__('users.title'))])

@section('style')
    <link rel="stylesheet" href="{{asset('/css/settings/users/create.min.css')}}"/>
@endsection

@section('content')
    <section class="users px-3">
        @include('settings.users.create.header')
       @include('settings.users.create.content')
    </section>
@endsection

@section('script')
    <script>

    </script>
    <script src="{{asset('/js/settings/users/create.min.js')}}"></script>
@endsection
