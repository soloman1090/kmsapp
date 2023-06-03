<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReturnToVoyagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voyager', function (Blueprint $table) {
            //
            $table->decimal('daily_return')->nullable();
            $table->decimal('total_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voyager', function (Blueprint $table) {
            //
        });
    }
}
