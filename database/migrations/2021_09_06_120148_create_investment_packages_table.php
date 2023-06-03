<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('category_name')->nullable();
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
            $table->string('package_type')->nullable();
            $table->string('active_status')->nullable();
            $table->string('start_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->decimal('level1_bonus')->nullable();
            $table->decimal('level2_bonus')->nullable();
            $table->decimal('level3_bonus')->nullable();
            $table->integer('running_days')->nullable();
            $table->integer('slots')->nullable();
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
        Schema::dropIfExists('investment_packages');
    }
}
