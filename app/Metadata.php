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
        $this->belongsTo('App\Artist');
    }

    public function discs()
    {
        $this->hasMany('App\Disc');
    }
}


