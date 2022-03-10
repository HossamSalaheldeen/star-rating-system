<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\AbstractService as Service;
use App\Utilities\CustomCollection;
use Illuminate\Support\Arr;

class UpdateUserService extends Service
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
            'initial_job_code',
            'code',
            'manager_id',
            'enterprise_id',
            'branch_id',
            'department_id',
        ]);

        if($data->userData['password'])
            $userData['password'] = $data->userData['password'];

        $data->user->update($userData);
        $data->user->roles()->sync($data->userData['role_id']);
        $data->user->viewerOn()->sync($data->userData['users_ids']);
        return $data->user;
    }
}
