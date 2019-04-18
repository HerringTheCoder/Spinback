<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function department()
    {
        $this->belongsTo('App/Department');
    }

    public function user()
    {
        $this->belongsTo('App/User');
    }

    public function disc()
    {
        $this->belongsTo('App/Disc');
    }
}
