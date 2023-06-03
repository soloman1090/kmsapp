<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBondPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bond_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('min_amt')->nullable();
            $table->integer('max_amt')->nullable();
            $table->decimal('min_percent')->nullable();
            $table->decimal('max_percent')->nullable();
            $table->integer('compound_duration')->nullable();
            $table->decimal('compound_percent')->nullable();
            $table->integer('duration')->nullable();
            $table->string('info_head_1')->nullable();
            $table->string('info_detail_1')->nullable();

            $table->string('info_head_2')->nullable();
            $table->string('info_detail_2')->nullable();

            $table->string('info_head_3')->nullable();
            $table->string('info_detail_3')->nullable();

            $table->string('info_head_4')->nullable();
            $table->string('info_detail_4')->nullable();

            $table->string('info_head_5')->nullable();
            $table->string('info_detail_5')->nullable();
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
        Schema::dropIfExists('bond_packages');
    }
}
