<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('investment_packages_id')->constrained()->onDelete('cascade');
            $table->string('date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('duration')->nullable();
            $table->decimal('returns')->nullable();
            $table->string('payout')->nullable();
            $table->string('txn_id')->nullable();
            $table->string('status')->nullable();
            $table->string('wallet_id')->nullable();
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
        Schema::dropIfExists('user_investments');
    }
}
