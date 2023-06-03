<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('blocked')->nullable();
            $table->boolean('verified')->nullable();
            $table->string('kyc')->nullable();
            $table->decimal('withdrawal_limit')->nullable();
            $table->boolean('invested')->nullable();
            $table->string('image')->nullable();
            $table->decimal('main_wallet')->nullable();
            $table->decimal('compound_wallet')->nullable();
            $table->integer('referred_by')->nullable();
            $table->string('referalcode')->nullable();
            $table->string('2facode')->nullable();
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
        Schema::dropIfExists('user_infos');
    }
}
