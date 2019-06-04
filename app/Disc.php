<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disc extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'album_id', 'condition', 'photo_path', 'offer_price', 'sold', 'department_id'
    ];

    public function album()
    {
        return $this->belongsTo('App\Album')->withTrashed();
    }

    public function department()
    {
        return $this->belongsTo('App\Department')->withTrashed();
    }

    public function requests()
    {
        return $this->hasOne('App\DeliveryRequest');
    }
}
