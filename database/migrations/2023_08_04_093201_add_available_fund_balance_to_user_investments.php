<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvailableFundBalanceToUserInvestments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_investments', function (Blueprint $table) {
            $table->decimal('available_fund_balance')->nullable();
            $table->decimal('active_interest_balance')->nullable();
            $table->string('by_weekly_next_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_investments', function (Blueprint $table) {
            //
        });
    }
}
