<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fundamental extends Model
{
    //
    /**
     * The attributes that are not mass  assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];
 //Relations
    public function symbol()
    {
        return $this->belongsTo('App\Symbol');
    }
}
