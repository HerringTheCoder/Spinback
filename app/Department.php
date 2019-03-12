<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable=['name', 'address', 'city', 'phone_number'
        ];

    public function requests()
    {
        return $this->hasMany('App\ShippingRequest');
    }

    public function roles()
    {
        return $this->hasMany('App\Role');
    }

}
