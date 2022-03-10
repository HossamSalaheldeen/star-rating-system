@extends('layout.app', ['title' => __('users.title')])

@section('style')
    <link rel="stylesheet" href="{{asset('/css/settings/users/index.min.css')}}">
@endsection

@section('content')
    <section class="users">
        @include('settings.users.body.header')
        @if(\App\Models\User::count() <= 1)
            <div class="no_content d-flex flex-column align-items-center justify-content-center">
                @include('layout.body.no-content')
            </div>
        @else
            @include('settings.users.body.filter')
            <div class="table-content">
                @include('layout.body.content')
            </div>
        @endif
        <div id="show-modal-container"></div>
    </section>
@endsection
@section('script')
    <script src="{{asset('/js/settings/users/list.min.js')}}"></script>
@endsection
