<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->integer('min_amt')->nullable();
            $table->integer('max_amt')->nullable();
            $table->decimal('charges')->nullable();
            $table->boolean('active')->nullable();
            $table->string('currency_code');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawal_methods');
    }
}
