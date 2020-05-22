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
    /**
     * Set the market cap to M
     *
     * @param  string  $value
     * @return void
     */
    public function getMarketCapAttribute($value)
    {
        $number = $value / 1000000;
        $number = number_format($number, 0) . ' M';
        return str_replace(",", " ", $number);

    }

    /**
     * Set the dividend yield to percentage
     *
     * @param  string  $value
     * @return void
     */
    public function getDividendYieldAttribute($value)
    {
        $number = $value * 100;
        return $number . ' %';

    }
    /**
     * Set the pe ratio to 2 digit after decimal
     *
     * @param  string  $value
     * @return void
     */
    public function getPeRatioAttribute($value)
    {
        return number_format($value, 2);

    }

}
