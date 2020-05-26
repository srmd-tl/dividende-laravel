<?php

namespace App\Http\Controllers;

use App\Fundamental;
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
        $excludedServices   = ["Conglomerates", "Consumer Goods", "Services", "Financial", "Industrial Goods", ""];
        $country            = request()->country ?? 'France';
        $symbolFundamentals = Fundamental::whereHas('symbol', function ($query) use ($country) {
               if(request()->tickerOrName)
            {
                $query
                ->where('Name','like','%'.request()->tickerOrName.'%')

                    ->orWhere('Code',request()->tickerOrName);
            }
            else
            {
                return $query->whereCountry($country);

            }
        })->whereNotIn('sector', $excludedServices);

    
        $mcOrder         = request()->mcOrder == 'up' ? 'asc' : 'desc';
        $dyOrder         = request()->dyOrder == 'up' ? 'asc' : 'desc';
        $peOrder         = request()->peOrder == 'up' ? 'asc' : 'desc';

        if (request()->mcOrder) {
            $symbolFundamentals = $symbolFundamentals
                ->orderBy('market_cap', $mcOrder);
        } elseif (request()->dyOrder) {
            $symbolFundamentals = $symbolFundamentals
                ->orderBy('dividend_yield', $dyOrder);
        } elseif (request()->peOrder) {

            $symbolFundamentals = $symbolFundamentals

                ->orderBy('pe_ratio', $peOrder);
        } else {
            $symbolFundamentals = $symbolFundamentals
                ->orderBy('market_cap', $mcOrder);
        }

        // dd( $symbolFundamentals->first());

        if (request()->minMc || request()->maxMc || request()->minPe || request()->maxPe || request()->minDy || request()->maxDy || request()->sector) {

            $symbolFundamentals = $symbolFundamentals->where(function ($subQuery1) {

                if (request()->maxMc) {
                    $subQuery1->where('market_cap', '>=', request()->minMc * 1000000)
                        ->where('market_cap', '<=', request()->maxMc * 1000000);
                } else {
                    $subQuery1->where('market_cap', '>=', request()->minMc * 1000000);
                }

            })
                ->where(function ($subQuery2) {
                    if (request()->maxDy) {

                        $subQuery2->where('dividend_yield', '>=', request()->minDy / 100)
                            ->where('dividend_yield', '<=', request()->maxDy / 100);
                    } else {

                        $subQuery2->where('dividend_yield', '>=', request()->minDy / 100);
                    }
                })
                ->where(function ($subQuery3) {

                    if (request()->maxPe) {
                        $subQuery3->where('pe_ratio', '>=', floatval(request()->minPe))
                            ->where('pe_ratio', '<=', floatval(request()->maxPe));
                    } else {
                        $subQuery3->where('pe_ratio', '>=', floatval(request()->minPe));
                    }
                });

        }
        
   
        $sectorsAndCount = (clone $symbolFundamentals)->groupBy('sector')->selectRaw('sector,count(*) as count')->get()->sort();
        $totalCount      =(clone  $symbolFundamentals)->count();
          
        if (request()->sector != "all" && isset(request()->sector)) {
                    $symbolFundamentals->where('sector', request()->sector);

                }
            
        return view('index', ['symbolFundamentals' => $symbolFundamentals->paginate(20), "sectorsAndCount" => $sectorsAndCount ?? null, "totalCount" => $totalCount]);
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
