<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    protected $fillable = [
        'tracking_code', 'completed'
    ];

    public function requests()
    {
        return $this->hasMany('App\ShippingRequest');
    }
}


