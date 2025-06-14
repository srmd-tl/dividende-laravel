<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
    //
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];
    //Relations
    public function fundamental()
    {
        return $this->hasOne('App\Fundamental');
    }
}
