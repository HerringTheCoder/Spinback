<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Parcel extends Model
{
    use SoftDeletes;
    protected $fillable = ['tracking_code','completed'];

    public function requests()
    {
        return $this->hasMany('App\ShippingRequest');
    }
}


