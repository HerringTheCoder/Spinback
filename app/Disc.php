<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Disc extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'album_id', 'condition', 'photo_path', 'offer_price', 'sold', 'department_id'
    ];

    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope('unsold', function (Builder $builder) {
        //     $builder->where('sold', 0);
        // });
    }

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

    public function scopeSold($query)
    {
        return $query->where('sold', 1);
    }

    public function scopeUnsold($query)
    {
        return $query->where('sold', 0);
    }

    public function scopeDepartment($query, $department)
    {
        return $query->where('department_id', $department);
    }
}
