<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReinvestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reinvest', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_investments_id')->constrained()->onDelete('cascade');
            $table->string('date')->nullable();
            $table->decimal('amount')->nullable(); 
            $table->decimal('topup_amount')->nullable();
            $table->decimal('returns')->nullable();
            $table->string('txn_id')->nullable();
            $table->string('status')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('reinvest');
    }
}
