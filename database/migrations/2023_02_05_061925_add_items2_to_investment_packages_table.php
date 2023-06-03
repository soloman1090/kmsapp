<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItems2ToInvestmentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investment_packages', function (Blueprint $table) {
            $table->integer('running_days')->nullable();
            $table->integer('slots')->nullable();
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
