<?php

namespace App\Services\Vendors;

use App\Models\PersonOfContact;
use App\Models\Vendor;
use App\Services\AbstractService as Service;
use App\Utilities\CustomCollection;
use Illuminate\Support\Arr;

class StoreVendorService extends Service
{

    /**
     * @param CustomCollection|null $data
     * @return mixed
     */
    public function handle(CustomCollection $data = null)
    {
        $vendorData = Arr::only($data->vendorData, [
            'name', 'email', 'vat_number', 'address',
            'city_id', 'market_id',
            'is_active', 'is_approved',
        ]);

        $PersonOfContactData = Arr::only($data->vendorData, ['names', 'emails', 'phones']);

        $PersonOfContacts = prepareArrayToSave($PersonOfContactData);

        $vendorData['is_approved'] = 1;
        $vendor = Vendor::create($vendorData);
        $vendor->personOfContacts()->createMany($PersonOfContacts);

        return $vendor;
    }
}
