<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Transaction extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function department()
    {
        return $this->belongsTo('App/Department')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo('App/User')->withTrashed();
    }

    public function disc()
    {
        return $this->belongsTo('App/Disc')->withTrashed();
    }
}
