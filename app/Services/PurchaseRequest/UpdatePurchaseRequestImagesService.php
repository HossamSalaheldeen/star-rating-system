<?php

namespace App\Services\PurchaseRequest;

use App\Services\AbstractService as Service;
use App\Traits\HasFiles;
use App\Utilities\CustomCollection;

class UpdatePurchaseRequestImagesService extends Service
{
    use HasFiles;

    /**
     * @param CustomCollection|null $data
     * @return mixed
     */
    public function handle(CustomCollection $data = null)
    {
//        dd($data->purchaseRequest->getMorphClass());
//        dd($data->attachment_ids);
       $t = $data->purchaseRequest->attachments()
            ->where('attachable_id', '=', $data->purchaseRequest->getKey())
            ->where('attachable_type', '=', $data->purchaseRequest->getMorphClass())
            ->whereNotIn('id', $data->attachment_ids)->delete();
//        dd($t);
        if ($data->attachments) {
            foreach ($data->attachments as $attachment) {
                $path = $this->storeFile('images', $attachment, $data->purchaseRequest);
                $data->purchaseRequest->attachments()->create(['filename' => $attachment->getClientOriginalName(), 'path' => $path]);
            }
        }

        return $data->purchaseRequest;

    }
}

