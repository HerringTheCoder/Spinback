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
        $this->belongsTo('App\Metadata');
    }

    public function departments()
    {
        $this->belongsTo('App\Metadata');
    }

    public function requests()
    {
        $this->hasOne('App\ShippingRequest');
    }


}
