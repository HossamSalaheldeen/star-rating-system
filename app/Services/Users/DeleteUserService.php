<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\AbstractService as Service;
use App\Utilities\CustomCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DeleteUserService extends Service
{

    /**
     * @param CustomCollection|null $data
     * @return mixed
     */
    public function handle(CustomCollection $data = null)
    {


        DB::table('user_viewer')->where('viewer_id', '=', $data->user->id)->delete();
        $data->user->delete();
    }
}
