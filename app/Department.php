<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $fillable=['name', 'address', 'city', 'phone_number'
        ];

    public function requests()
    {
        return $this->hasMany('App\ShippingRequest');
    }

}
