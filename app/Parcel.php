<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function requests()
    {
        return $this->hasMany('App\ShippingRequest');
    }
}


