<?php

namespace App\Console\Commands;

use App\Fundamental;
use Illuminate\Console\Command;

class RemoveDuplicates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:dups';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove Duplicated Rows';

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
        $duplicateRecords = Fundamental::select('name')
            ->selectRaw('count(`name`) as `occurences`')
            ->from('users')
            ->groupBy('name')
            ->having('occurences', '>', 1)
            ->get();

        foreach ($duplicateRecords as $record) {
            $record->delete();
        }
    }
}
