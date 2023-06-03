<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CompoundInterest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compound:interest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to compound interest daily';

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
     * @return int
     */
    public function handle()
    {
        app('App\Http\Controllers\CompoundInterest')->index();
        app('App\Http\Controllers\CompoundVoyage')->index();
        echo "All Done";
    }
}
