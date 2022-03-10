<div class="col-6 mb-4">
    <label for="name" class="form-label">{{__('users.properties.name')}} <span class="text-danger">*</span></label>
    <div class="input-container">
        <input type="text" class="form-control" id="name" name="name" placeholder="{{__('users.properties.name')}}"
               value="{{$user->name}}">
    </div>
</div>
<div class="col-6 mb-4">
    <label for="user-code" class="form-label">{{__('users.properties.code')}} <span class="text-danger">*</span></label>
    <div class="input-container">
        <input type="text" class="form-control" id="user-code" name="code" placeholder="{{__('users.properties.code')}}"
               value="{{$user->code}}">
    </div>
</div>
<div class="col-6 mb-4">
    <label for="email" class="form-label">{{__('users.properties.email')}} <span class="text-danger">*</span></label>
    <div class="input-container">
        <input type="text" class="form-control" id="email" name="email" placeholder="{{__('users.properties.email')}}"
               value="{{$user->email}}">
    </div>
</div>
<div class="col-6 mb-4">
    <label for="role" class="form-label">{{__('users.properties.role')}} <span class="text-danger">*</span></label>
    <div class="input-container">
        <select id="role-selector" class="form-select" aria-label="Default select" name="role_id" data-width="100%"
                data-placeholder="{{__('users.properties.role')}}">
            @if($user->roles->count())
                <option value="{{$user->roles->first()->id}}">{{$user->roles->first()->name}}</option>
            @endif
        </select>
    </div>
</div>
<div class="col-6 mb-4">
    <label for="password" class="form-label">{{ __('users.password') }} <span class="text-danger">*</span></label>
    <div class="input-container">
        <div class="input_icon">
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="Password">
            <button type="button" class="btn icons password-eye-icon">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>
</div>
<div class="col-6 mb-4">
    <label for="confirm-password" class="form-label">{{ __('users.confirm_password') }} <span
            class="text-danger">*</span></label>
    <div class="input-container">
        <div class="input_icon">
            <input type="password" class="form-control" id="confirm-password" name="password_confirmation"
                   placeholder="Confirm Password">
            <button type="button" class="btn icons password-eye-icon">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>
</div>
<div class="col-6 mb-4">
    <label for="department" class="form-label">{{__('users.properties.department')}} <span class="text-danger">*</span></label>
    <div class="input-container">
        <select id="department-selector" class="form-select" aria-label="Default select" name="department_id"
                data-width="100%" data-placeholder="{{__('users.properties.department')}}">
            @if($user->department_id)
                <option value="{{$user->department->id}}">{{$user->department->name}}</option>
            @endif
        </select>
    </div>
</div>
<div class="col-6 mb-4">
    <label for="manager" class="form-label">{{__('users.properties.manager')}}</label>
    <div class="input-container">
        <select id="manager-selector" class="form-select" aria-label="Default select" name="manager_id"
                data-width="100%" data-placeholder="{{__('users.properties.manager')}}">
            @if($user->manager_id)
                <option value="{{$user->manager->id}}">{{$user->manager->name}}</option>
            @endif
        </select>
    </div>
</div>
<div class="col-6 mb-4">
    <label for="initial-job-code" class="form-label">{{__('users.properties.initial_job_code')}} </label>
    <div class="input-container">
        <input type="text" class="form-control" id="initial-job-code" name="initial_job_code"
               placeholder="{{__('users.properties.initial_job_code')}}" value="{{$user->initial_job_code}}">
    </div>
</div>
<div class="col-6 mb-3">
    <label for="enterprise" class="form-label">{{__('users.properties.enterprise')}} <span class="text-danger">*</span></label>
    <div class="input-container">
        <select id="enterprise-selector" class="form-select" aria-label="Default select" name="enterprise_id"
                data-width="100%" data-placeholder="{{__('users.properties.enterprise')}}">
            @if($user->enterprise_id)
                <option value="{{$user->enterprise->id}}">{{$user->enterprise->name}}</option>
            @endif
        </select>
    </div>
</div>
<div class="col-6 mb-3">
    <label for="enterprise" class="form-label">{{__('users.properties.branch')}} <span
            class="text-danger">*</span></label>
    <div class="input-container">
        <select id="branch-selector" class="form-select" aria-label="Default select" name="branch_id" data-width="100%"
                data-placeholder="{{__('users.properties.branch')}}" @if(!$user->branch_id) disabled @endif>
            @if($user->branch_id)
                <option value="{{$user->branch->id}}" selected>{{$user->branch->name}}</option>
            @endif
        </select>
    </div>
</div>
<div class="col-6 mb-3">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" name="is_viewer"
               id="is-viewer-checkbox">
        <label class="form-check-label" for="remember">
            Is Viewer
        </label>
    </div>
</div>

<div class="viewers_container col-6 mb-3 d-none">
    <label for="cars" class="form-label">Users<span
            class="text-danger">*</span></label>
    <select class="w-100" name="users_ids[]" id="users-selector" multiple multiselect-search="true" all="true"
            multiselect-max-items="2" placeholder="Users">
        @foreach($users as $user)
            <option
                value="{{$user->id}}" {{in_array($user->id,$viewedUsers) ? 'selected' : ''}}>{{$user->name}}</option>
        @endforeach
    </select>
</div>
