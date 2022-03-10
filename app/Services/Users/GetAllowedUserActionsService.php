<?php

namespace App\Services\Users;

use App\Enums\PermissionEnum;
use App\Models\User;
use App\Services\AbstractService as Service;
use App\Utilities\CustomCollection;

class GetAllowedUserActionsService extends Service
{

    public function handle( CustomCollection $data = null )
    {
        return [
            'create'        =>$data->user->hasPermissionTo( getPermissionName( PermissionEnum::CREATE, User::class ) ),
            'show'          => $data->user->hasPermissionTo( getPermissionName( PermissionEnum::VIEW, User::class ) ),
            'edit'          => $data->user->hasPermissionTo( getPermissionName( PermissionEnum::UPDATE, User::class ) ),
            'delete'        => $data->user->hasPermissionTo( getPermissionName( PermissionEnum::DELETE, User::class ) ),
            'toggle_active' => $data->user->hasPermissionTo( getPermissionName( PermissionEnum::TOGGLE_ACTIVE, User::class ) ),
        ];
    }
}