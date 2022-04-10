<?php

namespace App\Services\PurchaseRequest;

use App\Services\AbstractService as Service;
use App\Traits\HasFiles;
use App\Utilities\CustomCollection;

class StorePurchaseRequestImagesService extends Service
{
    use HasFiles;

    /**
     * @param CustomCollection|null $data
     * @return mixed
     */
    public function handle(CustomCollection $data = null)
    {

//        if($data->purchaseRequestImages) {
//            foreach ($data->purchaseRequestImages as $image) {
//                $path = $this->storeFile('images', $image, $data->purchaseRequest);
//                $data->purchaseRequest->images()->create(['path' => $path]);
//            }
//        }

        foreach ($data->attachments as $attachment) {
            $path = $this->storeFile('images', $attachment, $data->purchaseRequest);
            $data->purchaseRequest->attachments()->create(['filename' => $attachment->getClientOriginalName(), 'path' => $path]);
        }

        return $data->purchaseRequest;

    }
}

