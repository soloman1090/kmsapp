<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentLibariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_libaries', function (Blueprint $table) {
            $table->id();
            $table->longText('resource_link')->nullable();
            $table->longText('status') ;
            $table->longText('extention')->nullable();
            $table->longText('category')->nullable();
            $table->longText('description')->nullable();
            $table->longText('slug')->nullable();
            $table->longText('gallery_category')->nullable();
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
        Schema::dropIfExists('content_libaries');
    }
}
