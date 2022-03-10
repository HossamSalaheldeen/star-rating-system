<div class="create_content p-4 border border-3 rounded">
    <div class="title-info-box">
        <span class="fs-4 fw-normal">{{\Str::singular(__('users.title'))}} {{ __('users.info') }}</span>
    </div>
    @include('settings.users.edit.form')
</div>
