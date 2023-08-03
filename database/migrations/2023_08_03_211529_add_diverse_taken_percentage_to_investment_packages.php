<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiverseTakenPercentageToInvestmentPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investment_packages', function (Blueprint $table) {
            $table->decimal('diverse_taken_percentage')->nullable();
            $table->string('geography')->nullable();
            $table->string('strategy')->nullable();
            $table->string('portfolio_fund_targets')->nullable();
            $table->string('strategy_focus')->nullable();
            $table->string('target_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investment_packages', function (Blueprint $table) {
            //
        });
    }
}
