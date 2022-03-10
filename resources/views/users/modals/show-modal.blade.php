<div class="modal fade show_modal" id="show-modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="showUser"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{\Str::singular(__('users.title'))}} {{ __('users.info') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="m-4 row">
                    <div class="col-6">
                        <div class="d-flex flex-column align-items-start justify-content-between">
                            <span class="fw-bold">
                                Full Name
                            </span>
                            <span>
                                {{$user->name}}
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column align-items-start justify-content-between">
                            <span class="fw-bold">
                                User Code
                            </span>
                            <span>
                                {{$user->code}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="m-4 row">
                    <div class="col-6">
                        <div class="d-flex flex-column align-items-start justify-content-between">
                            <span class="fw-bold">
                                Email
                            </span>
                            <span>
                                {{$user->email}}
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column align-items-start justify-content-between">
                            <span class="fw-bold">
                                Role
                            </span>
                            <span>
                                {{$user->roles()->first()->name}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="m-4 row">
                    <div class="col-6">
                        <div class="d-flex flex-column align-items-start justify-content-between">
                            <span class="fw-bold">
                               Department
                            </span>
                            <span>
                                {{$user->department->name}}
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column align-items-start justify-content-between">
                            <span class="fw-bold">
                                Manager
                            </span>
                            <span>
                                {{$user->manager ? $user->manager->name : '-'}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="m-4 row">
                    <div class="col-6">
                        <div class="d-flex flex-column align-items-start justify-content-between">
                            <span class="fw-bold">
                                Enterprise
                            </span>
                            <span>
                                {{$user->enterprise->name}}
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column align-items-start justify-content-between">
                            <span class="fw-bold">
                                Initial Job Code
                            </span>
                            <span>
                                {{$user->initial_job_code}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="m-4 row">
                    <div class="col-6">
                        <div class="d-flex flex-column align-items-start justify-content-between">
                            <span class="fw-bold">
                                Branch
                            </span>
                            <span>
                                {{$user->branch->name}}
                            </span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
