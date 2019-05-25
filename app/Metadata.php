<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    protected $fillable = [
        'title', 'artist_id', 'genre', 'country', 'release_year', 'format'
        ];

    public function artist()
    {
        return $this->belongsTo('App\Artist', 'artist_id');
    }

    public function discs()
    {
        return $this->hasMany('App\Disc');
    }
}


