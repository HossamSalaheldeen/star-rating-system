<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\AbstractService as Service;
use App\Utilities\CustomCollection;

class GetAllUsersService extends Service
{
    /**
     * @param CustomCollection|null $data [filterData => [],perPagePaginator => int, query => [] , withRelations => []]
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function handle( CustomCollection $data = null )
    {
        return User::query()
                   ->with( $data->withRelations ?? [] )
                   ->filter( $data->filterData )
                   ->notOwner()
                   ->latest()
                   ->paginate( $data->perPagePaginator )
                   ->appends( $data->query );
    }
}
