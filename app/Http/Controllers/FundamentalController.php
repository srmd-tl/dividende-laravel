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
        $sectorsAndCount = Fundamental::groupBy('sector')->selectRaw('sector,count(*) as count')->get();

        $data;
        $country            = request()->country ?? 'France';
        $symbolFundamentals = Fundamental::whereHas('symbol', function ($query) use ($country) {
            return $query->whereCountry($country);
        });

        if (request()->mcOrder || request()->dyOrder || request()->peOrder) {
            $symbolFundamentals = $symbolFundamentals->where(function ($subQuery5) {

                $mcOrder = request()->mcOrder == 'down' ? 'desc' : 'asc';
                $dyOrder = request()->dyOrder == 'down' ? 'desc' : 'asc';
                $peOrder = request()->peOrder == 'down' ? 'desc' : 'asc';

                $subQuery5
                    ->orderBy('market_cap', $mcOrder)
                    ->orderBy('dividend_yield', $dyOrder)
                    ->orderBy('pe_ratio', $peOrder);

            });
        }
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
                })
                ->where(function ($subQuery4) {
                    if (request()->sector != "all") {
                        $subQuery4->where('sector', request()->sector);

                    }
                })
                ->where(function ($subQuery5) {
                    $mcOrder = request()->mcOrder == 'down' ? 'desc' : 'asc';
                    $dyOrder = request()->dyOrder == 'down' ? 'desc' : 'asc';
                    $peOrder = request()->peOrder == 'down' ? 'desc' : 'asc';

                    $subQuery5
                        ->orderBy('market_cap', $mcOrder)
                        ->orderBy('dividend_yield', $dyOrder)
                        ->orderBy('pe_ratio', $peOrder);

                });
            
        }

        // ->when(request()->minMc || request()->maxMc, function ($query) {
        // return $query->where(function ($sub) {
        //     if (request()->maxMc) {
        //          $sub->where('market_cap', ' >= ', request()->minMc)
        //             ->where('market_cap', ' <= ', request()->maxMc);
        //     } else {
        //          $sub->where('market_cap', ' >= ', request()->minMc);
        //     }

        // })
        // ->orWhere( function ($sub2) {
        //     if (request()->maxMc) {
        //          $sub2->where('dividend_yield', ' >= ', request()->minDy)
        //             ->where('dividend_yield', ' <= ', request()->maxDy);
        //     } else {
        //          $sub2->where('dividend_yield', ' >= ', request()->minDy);
        //     }
        // })
        //  ->orWhere( function ($sub3) {
        //     if (request()->maxMc) {
        //          $sub3->where('pe_ratio', ' >= ', request()->minPe)
        //             ->where('pe_ratio', ' <= ', request()->maxPe);
        //     } else {
        //          $sub3->where('pe_ratio', ' >= ', request()->minPe);
        //     }
        // })

        //     ;
        // })
        

        
        // $symbolFundamentals = Fundamental::with(['symbol'=>function($query) use ($country){
        //     return $query->whereCountry($country);
        // }])->paginate(20);
        return view('index', ['symbolFundamentals' => $symbolFundamentals->paginate(20), "sectorsAndCount" => $sectorsAndCount]);
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
