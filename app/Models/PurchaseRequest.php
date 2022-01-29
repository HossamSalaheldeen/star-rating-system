<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'requestable_id', 'requestable_type'];

    public function requestable()
    {
        return $this->morphTo();
    }
}
