<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Artist extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'name', 'country', 'description'
        ];

    public function metadata()
    {
        return $this->hasMany('App\Metadata');
    }
}
