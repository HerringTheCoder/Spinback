<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable=[
        'name', 'country', 'description'
        ];

    public function metadata()
    {
        return $this->hasMany('App\Metadata');
    }
}
