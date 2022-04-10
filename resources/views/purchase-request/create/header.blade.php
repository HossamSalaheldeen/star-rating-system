<div class="create_header my-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
{{--        <a href="{{route('settings.leads.show', $model)}}">--}}
{{--            <span class="material-icons-outlined pb-1">arrow_back_ios</span>--}}
{{--        </a>--}}
        <span class="ms-2 fs-3 fw-bolder">{{ __('purchase-request.create') }} {{\Str::singular(__('purchase-request.title'))}}</span>
    </div>
    <button type="submit" class="btn" form="create-purchase-request-form">{{ __('purchase-request.create-btn') }}</button>
</div>
