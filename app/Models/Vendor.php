<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Vendor extends Model
{
    use HasFactory, Rateable;

    protected $fillable = ['name'];
}
