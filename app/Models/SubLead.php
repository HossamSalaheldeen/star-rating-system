<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLead extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'lead_id'];

    public function lead() {
        return $this->belongsTo(Lead::class);
    }

    public function purchaseRequests()
    {
        return $this->morphMany(PurchaseRequest::class, 'requestable');
    }
}
