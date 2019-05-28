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

    public function discs()
    {
        return $this->hasMany('App\Disc');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

}
