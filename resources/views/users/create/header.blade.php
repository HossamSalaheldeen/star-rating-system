<div class="create_header my-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
        <a href="{{route("settings.users.index")}}">
            <span class="material-icons-outlined pb-1">arrow_back_ios</span>
        </a>
        <span class="ms-2 fs-3 fw-bolder">{{ __('users.create') }} {{\Str::singular(__('users.title'))}}</span>
    </div>
    <button type="submit" class="btn" form="create-user-form">{{ __('users.create_btn') }}</button>
</div>
