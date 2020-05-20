<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('index');
});

Route::get('eod', function () {

    $stock = Eod::stock();

// JSON
   dd($stock->fundamental('AAPL.US')->json());
  

    $exchange = Eod::exchange();
// JSON
    $data = $exchange->symbol('US')->json();
    dd($data);
});

Route::get('ticker', function () {
    $exchange = Eod::exchange();
    $data     = $exchange->multipleTicker('US')->json();
    dd($data);

});


Route::resource('symbol','SymbolController');