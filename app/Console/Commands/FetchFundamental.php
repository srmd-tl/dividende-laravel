<?php

namespace App\Console\Commands;

use App\Fundamental;
use App\Symbol;
use Eod;
use Exception;
use Illuminate\Console\Command;
use Log;

class FetchFundamental extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:fundamental';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is to fetch fundamental data from EODHistoricalData.com';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $stock   = Eod::stock();
        $symbols = Symbol::whereType('Common Stock')->get();

        try {

            foreach ($symobls as $symbol) {
                $data = json_decode($stock->fundamental($symbol->code . ',' . $symbol->Country == 'USA' ? 'US' : $symbol->Exchange)->json());
                if ($data) {
                    $insertionData = [
                        "symbol_id"      => $symbol->id,
                        "sector"         => $data->General->Sector,
                        "market_cap"     => $data->Highlights->MarketCapitalization,
                        "dividend_yield" => $data->Highlights->DividendYield,
                        "pe_ratio"       => $data->Highlights->PERatio,

                    ];
                    Fundamental::create($insertionData);
                }

            }
        } catch (Exception $e) {
            Log::info($e->getMessage());

        }

        Log::info('Completed!');

        // Common Stock
        // dd($data->Highlights->MarketCapitalization); //US
        // dd($data->Highlights->PERatio); //US
        // dd($data->Highlights->DividendYield); //US
        // dd($data->General->Sector); //US

        // ETF

        // https: //eodhistoricaldata.com/api/fundamentals/ACWI.PA?api_token=5ebeb0ea227ad6.87181921
        // https: //eodhistoricaldata.com/api/fundamentals/ARTNA.US?api_token=5ebeb0ea227ad6.87181921
        // https: //eodhistoricaldata.com/api/fundamentals/0QOT.LSE?api_token=5ebeb0ea227ad6.87181921
        // https://eodhistoricaldata.com/api/fundamentals/4HM.F?api_token=5ebeb0ea227ad6.87181921
        // https: //eodhistoricaldata.com/api/fundamentals/AAAU.US?api_token=5ebeb0ea227ad6.87181921

    }
}
