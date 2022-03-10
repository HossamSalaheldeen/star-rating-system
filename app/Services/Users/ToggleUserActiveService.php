<?php

namespace App\Services\Users;

use App\Services\Shared\ToggleActiveService;
use App\Utilities\CustomCollection;

class ToggleUserActiveService extends ToggleActiveService
{

    /**
     * @param CustomCollection|null $data [user => User::class ]
     */
    public function handle( CustomCollection $data = null )
    {
       return parent::handle(customCollect(['resource' => $data->user]));
    }
}
