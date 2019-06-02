<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $dates = [
        'release_date'
    ];

    protected $fillable = [
        'id', 'title', 'artist_id', 'genre', 'cover', 'release_date'
    ];

    public function artist()
    {
        return $this->belongsTo('App\Artist', 'artist_id')->withTrashed();
    }

    public function discs()
    {
        return $this->hasMany('App\Disc');
    }
}
