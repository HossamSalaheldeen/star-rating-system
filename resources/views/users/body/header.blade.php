<div class="body_header m-4 d-flex align-items-center justify-content-between">
    <h3 class="fw-bolder">{{__('users.title')}}</h3>
    @if(\App\Models\User::count() > 1)
        @if(array_key_exists('create', $actions) && $actions['create'])
            <a class="link"
               href="{{route('settings.users.create')}}">{{ __('users.create_new') }} {{Str::singular(__('users.title'))}}</a>
        @endif
    @endif
</div>
