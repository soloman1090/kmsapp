<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->longText('title')->nullable();
            $table->longText('subject')->nullable();
            $table->longText('descp')->nullable();
            $table->string('action_text')->nullable();
            $table->string('action_url')->nullable();
            $table->longText('descp2')->nullable();
            $table->longText('descp3')->nullable();
            $table->string('img')->nullable();
            $table->string('img_event')->nullable();
            $table->longText('end_text')->nullable();
            $table->string('sent_status')->nullable();
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
        Schema::dropIfExists('manage_emails');
    }
}
