<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingRequest extends Model
{
    protected $fillable = [
        'source_id', 'target_id', 'disc_id', 'accepted', 'comments'
    ];
}


