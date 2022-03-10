<?php


namespace App\Services\Users;


use App\Services\AbstractService as Service;
use App\Utilities\CustomCollection;

class MapUsersTableData extends Service
{

    /**
     * @var \Illuminate\Pagination\LengthAwarePaginator
     * */
    private $users;

    /**
     * @param CustomCollection|null $data [users => [user, user]]
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function handle( CustomCollection $data = null )
    {
        $this->users = $data->users;
        return $this->users->setCollection( $this->mapUsers() );
    }

    private function mapUsers()
    {
        return collect( $this->users->map( function ( $user ) {
            $userObject             = customCollect();
            $userObject->id         = $user->id;
            $userObject->name       = $user->name;
            $userObject->email      = $user->email;
            $userObject->code       = $user->code;
            $userObject->is_active  = $user->is_active;
            $userObject->manager    = optional( $user->manager )->name;
            $userObject->enterprise = optional( $user->enterprise )->name;
            $userObject->branch     = optional( $user->branch )->name;
            $userObject->role       = optional( $user->roles->first() )->name;
            $userObject->department = optional( $user->department )->name;
            return $userObject;
        } ) );
    }
}
