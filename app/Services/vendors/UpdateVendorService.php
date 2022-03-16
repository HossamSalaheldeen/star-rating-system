<?php

namespace App\Services\Vendors;

use App\Models\PersonOfContact;
use App\Services\AbstractService as Service;
use App\Utilities\CustomCollection;
use Illuminate\Support\Arr;
use App\Enums\PermissionEnum;
use PhpParser\Node\Expr\Array_;

class UpdateVendorService extends Service
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
        $contacts = Array();
        foreach ($PersonOfContacts as $PersonOfContact) {
            $PersonOfContact['vendor_id'] = $data->vendor->id;
            $PersonOfContact['created_by'] = \Auth::id();
            $PersonOfContact['updated_by'] = \Auth::id();
            $contacts[] = $PersonOfContact;
        }

        $data->vendor->update($vendorData);

        $personOfContactsFrontIds = array_keys(head($PersonOfContactData));
        $personOfContactsBackIds = $data->vendor->personOfContacts()->pluck('id')->toArray();
        $personOfContactsIdsToDelete = array_diff($personOfContactsBackIds, $personOfContactsFrontIds);

        if (count($personOfContactsIdsToDelete) > 0) {
            //PersonOfContact::where('vendor_id',$data->vendor->id)->whereIn('id', $personOfContactsIdsToDelete)->delete();
            $data->vendor->personOfContacts()->whereIn('id', $personOfContactsIdsToDelete)->delete();
        }

        PersonOfContact::upsert($contacts,
            'email',
            [
                'name',
                'email',
                'phone',
                'vendor_id'
            ]
//            +
//            [
//                'created_by' => \Auth::id(),
//                'updated_by' => \Auth::id(),
//            ]
        );
        // dd($data->vendor->id);
//        if ($vendor) {
//
//            $personOfContact = array(
//                'vendor_id' => $data->vendor->id,  'name' => $PersonOfContactData['poc_name'],
//                'email' => $PersonOfContactData['poc_email'],
//                'phone' => $PersonOfContactData['poc_phone'],
//            );
//            if (PersonOfContact::where('vendor_id', $data->vendor->id)->first() != null)
//                PersonOfContact::where('vendor_id', $data->vendor->id)->first()->update($personOfContact);
//            else {
//                PersonOfContact::create($personOfContact);
//            }
//        }

        return $data->vendor;
    }
}
