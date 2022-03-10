@extends('layout.app', ['title' => 'Edit ' . Str::singular(__('users.title'))])

@section('style')
    <link rel="stylesheet" href="{{asset('/css/settings/users/edit.min.css')}}"/>
@endsection

@section('content')
    <section class="users px-3">
        @include('settings.users.edit.header')
        @include('settings.users.edit.content')
    </section>
@endsection

@section('script')
    <script src="{{asset('/js/settings/users/edit.min.js')}}"></script>
@endsection
