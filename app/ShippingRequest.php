<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingRequest extends Model
{
    protected $fillable = [
        'source_id', 'target_id', 'disc_id', 'accepted', 'comments'
    ];

    public function source()
    {
        return $this->belongsTo('App/Department');
    }

    public function destination()
    {
        return $this->belongsTo('App\Department');
    }

    public function disc()
    {
        return $this->belongsTo('App\Disc');
    }
}


