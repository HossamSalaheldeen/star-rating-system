<?php

namespace App\Http\Controllers\Settings;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UserRequest;
use App\Mail\WelcomeMail;
use App\Models\Role;
use App\Models\User;
use App\Services\Users\DeleteUserService;
use App\Services\Users\GetAllowedUserActionsService;
use App\Services\Users\GetAllUsersService;
use App\Services\Users\GetUsersTableColumnsService;
use App\Services\Users\MapUsersTableData;
use App\Services\Users\StoreUserService;
use App\Services\Users\ToggleUserActiveService;
use App\Services\Users\UpdateUserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    protected function resourceAbilityMap()
    {
        return array_merge(
            parent::resourceAbilityMap(),
            [
                'toggleActive' => 'toggleActive'
            ]
        );
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param GetUsersTableColumnsService $getUsersTableColumnsService
     * @param GetAllUsersService $getAllUsersService
     * @param MapUsersTableData $mapUsersTableData
     * @param GetAllowedUserActionsService $getAllowedUserActionsService
     * @return Application|Factory|View
     */
    public function index(Request $request,
                          GetUsersTableColumnsService $getUsersTableColumnsService,
                          GetAllUsersService $getAllUsersService,
                          MapUsersTableData $mapUsersTableData,
                          GetAllowedUserActionsService $getAllowedUserActionsService)
    {

        $filterData = $request->only('name', 'role', 'email', 'code','active');

        $users = $getAllUsersService->handle(customCollect([
            'filterData' => $filterData,
            'perPagePaginator' => self::$perPagePaginator,
            'query' => $request->query(),
            'withRelations' => [
                'manager:id,name',
                'roles:id,name',
                'department:id,name',
                'enterprise:id,name',
                'branch:id,name'
            ]
        ]));

        $data = $mapUsersTableData->handle(customCollect(compact('users')));

        $fields = $getUsersTableColumnsService->handle();

        $role = Role::find($request->role);

        $actions = $getAllowedUserActionsService->handle(customCollect(['user' => \Auth::user()]));


        if ($request->ajax())
            return view('layout.body.content', compact('data', 'fields','actions') + ['resource'=> 'users']);

        return view('settings.users.index', compact('data', 'role', 'fields','actions')+ ['resource'=> 'users']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $user = new User();
        $users = User::query()->select(['id','name'])->where('id','!=',$user->id)->notOwner()->get();
        $viewedUsers = [];
        return view('settings.users.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request, StoreUserService $storeUserService)
    {
        $userData = $request->only([
            'name',
            'email',
            'initial_job_code',
            'code',
            'password',
            'manager_id',
            'enterprise_id',
            'department_id',
            'role_id',
            'branch_id',
            'users_ids'
        ]);

        $userData['is_active'] = true;


        $user = $storeUserService->handle(customCollect([
            'userData' => $userData
        ]));

//        \Mail::to($user)->send(new WelcomeMail($userData['email'],$userData['password']));

        return $this->jsonSuccessResponse([
            'redirect' => route('settings.users.index'),
        ], __('users.created'), ResponseCode::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function show(User $user)
    {
        return view('settings.users.modals.show-modal', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function edit(User $user)
    {

        $users = User::query()->select(['id','name'])->where('id','!=',$user->id)->notOwner()->get();
        $viewedUsers = $user->viewerOn->pluck('id')->toArray();
        return view('settings.users.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UserRequest $request,UpdateUserService $updateUserService, User $user)
    {

        $updateUserService->handle(customCollect([
            'user' => $user,
            'userData' => $request->only([
                'name',
                'email',
                'password',
                'initial_job_code',
                'code',
                'manager_id',
                'enterprise_id',
                'department_id',
                'role_id',
                'branch_id',
                'users_ids'
            ])
        ]));

        return $this->jsonSuccessResponse([
            'redirect' => route('settings.users.index'),
        ], __('users.updated'), ResponseCode::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(DeleteUserService $deleteUserService,User $user)
    {
        $deleteUserService->handle(customCollect([
            'user' => $user,
        ]));

        return $this->jsonSuccessResponse([
        ], __('users.deleted'), ResponseCode::HTTP_ACCEPTED);
    }

    public function toggleActive(User $user,ToggleUserActiveService $toggleUserActiveService)
    {
//        $this->authorize('toggleActive',$user);
        $toggleUserActiveService->handle(customCollect(compact('user')));
        return $this->jsonSuccessResponse([
        ], __('users.activation_changed'), ResponseCode::HTTP_ACCEPTED);
    }
}
