<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Lead extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = ['name'];


    public function getActivitylogOptions(): LogOptions
    {

        return LogOptions::defaults()
            ->useLogName('timeline');
        // Chain fluent methods for configuration options
    }

    public function subLeads() {
        return $this->hasMany(SubLead::class);
    }

    public function purchaseRequests()
    {
        return $this->morphMany(PurchaseRequest::class, 'requestable');
    }
}
