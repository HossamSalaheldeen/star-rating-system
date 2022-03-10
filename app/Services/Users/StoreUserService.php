<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\AbstractService as Service;
use App\Utilities\CustomCollection;
use Illuminate\Support\Arr;

class StoreUserService extends Service
{

    /**
     * @param CustomCollection|null $data
     * @return mixed
     */
    public function handle(CustomCollection $data = null)
    {
        $userData = Arr::only($data->userData,[
            'name',
            'email',
            'password',
            'initial_job_code',
            'code',
            'manager_id',
            'enterprise_id',
            'branch_id',
            'department_id',
            'is_active'
        ]);
        $user = User::create($userData);
        $user->roles()->attach($data->userData['role_id']);
        $user->viewerOn()->attach($data->userData['users_ids']);
        return $user;
    }
}
