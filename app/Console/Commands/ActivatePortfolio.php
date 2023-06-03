<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ActivatePortfolio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activate:portfolio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to activate pending portfolios every once pending';

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
        app('App\Http\Controllers\ActivatePortfolios')->index();
        app('App\Http\Controllers\ActivateReinvestments')->index();
        app('App\Http\Controllers\AutoSendMails')->index();
        echo "-- Activated --  ";
    }
}
