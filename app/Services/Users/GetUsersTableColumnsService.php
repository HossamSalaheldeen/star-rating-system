<?php


namespace App\Services\Users;


use App\Services\AbstractService as Service;
use App\Utilities\CustomCollection;

class GetUsersTableColumnsService extends Service
{
    /**
     * @param CustomCollection|null $data
     * @return array
     */
    public function handle(CustomCollection $data = null)
    {
        return [
            'name',
            'code',
            'manager',
            'enterprise',
            'branch',
            'role',
        ];
    }
}
