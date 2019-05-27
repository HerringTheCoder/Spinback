<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Metadata extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'artist_id', 'genre', 'country', 'release_year', 'format'
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


