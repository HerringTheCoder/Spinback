<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disc extends Model
{
    protected $fillable = [
        'metadata_id', 'condition', 'photo_path', 'offer_price', 'sold', 'department_id'
    ];

    public function metadata()
    {
       return $this->belongsTo('App\Metadata');
    }

    public function departments()
    {
        return $this->belongsTo('App\Department');
    }

    public function requests()
    {
        return $this->hasOne('App\ShippingRequest');
    }


}
