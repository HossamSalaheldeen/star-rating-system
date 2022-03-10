<form action="{{route('settings.users.index')}}" id="search-form" class="form-inline" method="GET">
    <div class="body_filter m-4 p-3 d-flex align-items-center justify-content-between border border-1">
        <div class="w-100 me-2">
            <select class="form-select " aria-label="Default select" id="role-selector"  title="{{__('users.properties.role')}}"
                    name="role" data-width="100%" data-placeholder="{{__('users.properties.role')}}">
                @if($role)
                    <option value="{{$role->id}}" selected>{{$role->name}}</option>
                @endif
            </select>
        </div>
        <div class="w-100 me-2">
            <input type="text" class="form-control" id="name" name="name" placeholder="{{__('users.properties.name')}}" aria-label="search"
                   aria-describedby="button-addon2" value="{{request()->name}}" title="{{__('users.properties.name')}}">
        </div>
        <div class="w-100 me-2">
            <input type="text" class="form-control" id="code" name="code" placeholder="{{__('users.properties.code')}}" aria-label="search"
                   aria-describedby="button-addon2" value="{{request()->code}}" title="{{__('users.properties.code')}}">
        </div>
{{--        <div class="w-100 me-2">--}}
{{--            <input type="email" class="form-control" id="email" name="email" placeholder="{{__('users.properties.email')}}" aria-label="search"--}}
{{--                   aria-describedby="button-addon2" value="{{request()->email}}" title="{{__('users.properties.email')}}">--}}
{{--        </div>--}}
        <div class="w-100 me-2">
            <select class="form-select " aria-label="Default select" id="active-selector"  title="Active Status"
                    name="active" data-width="100%" data-placeholder="Active Status">
                    <option></option>
                    <option value="0">Deactive</option>
                    <option value="1">Active</option>
            </select>
        </div>
        <div class="w-100 align-self-end">
            <button type="button" class="btn search-btn" data-url="{{route('settings.users.index')}}">{{ __('users.search_btn') }}</button>
        </div>
    </div>
</form>
