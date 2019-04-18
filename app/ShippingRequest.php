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
        $this->belongsTo('App/Department');
    }

    public function destination()
    {
        $this->belongsTo('App\Department');
    }

    public function disc()
    {
        $this->belongsTo('App\Disc');
    }
}


