<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function department()
    {
        return $this->belongsTo('App/Department');
    }

    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function disc()
    {
        return $this->belongsTo('App/Disc');
    }
}
