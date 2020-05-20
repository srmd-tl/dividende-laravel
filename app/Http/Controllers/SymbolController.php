<?php

namespace App\Http\Controllers;

use App\Symbol;
use Eod;
use Illuminate\Http\Request;

class SymbolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Symbol::whereType('FUND')->delete();
      
        dd(Symbol::all()->count());

 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function show(Symbol $symbol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function edit(Symbol $symbol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symbol $symbol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symbol $symbol)
    {
        //
    }

    /*Call to api to get symbols against an exchange*/
    public function getSymbol($exchange)
    {
        $exchange = Eod::exchange();
        dd($exchange->symbol("F")->json());

    }
}
