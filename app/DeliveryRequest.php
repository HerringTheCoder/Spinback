<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DeliveryRequest extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'source_id', 'target_id', 'disc_id', 'accepted', 'comments'
    ];

    public function source()
    {
        return $this->belongsTo('App\Department')->withTrashed();
    }

    public function destination()
    {
        return $this->belongsTo('App\Department')->withTrashed();
    }

    public function disc()
    {
        return $this->belongsTo('App\Disc');
    }
}


