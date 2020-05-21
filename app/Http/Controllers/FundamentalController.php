<?php

namespace App\Http\Controllers;

use App\Fundamental;
use App\Symbol;
use Illuminate\Http\Request;

class FundamentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country            = request()->country ?? 'France';
        $symbolFundamentals = Fundamental::with(['symbol'=>function($query) use ($country){
            return $query->whereCountry($country);
        }])->paginate(20);
        return view('index',['symbolFundamentals'=>$symbolFundamentals]);
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
     * @param  \App\Fundamental  $fundamental
     * @return \Illuminate\Http\Response
     */
    public function show(Fundamental $fundamental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fundamental  $fundamental
     * @return \Illuminate\Http\Response
     */
    public function edit(Fundamental $fundamental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fundamental  $fundamental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fundamental $fundamental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fundamental  $fundamental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fundamental $fundamental)
    {
        //
    }
}
