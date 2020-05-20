<?php

use App\Symbol;
use Illuminate\Database\Seeder;

class SymbolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $us    = file_get_contents((__DIR__ . '/us.json'));
        $uk    = file_get_contents((__DIR__ . '/uk.json'));
        $de    = file_get_contents((__DIR__ . '/de.json'));
        $fr    = file_get_contents((__DIR__ . '/fr.json'));
        $usArr = json_decode($us, true);
        $ukArr = json_decode($uk, true);
        $deArr = json_decode($de, true);
        $frArr = json_decode($fr, true);
        set_time_limit(0);

        foreach (array_chunk($usArr, 1000) as $t) {
            Symbol::insert($t);
        }
        Symbol::insert($ukArr);
        Symbol::insert($deArr);
        Symbol::insert($frArr);

        Symbol::whereType('FUND')->delete();
    }
}
