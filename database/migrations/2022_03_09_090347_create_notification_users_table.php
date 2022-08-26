<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_users', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['read','notRead']);
            $table->unsignedBigInteger('id_notification');
            $table->unsignedBigInteger('id_users');
            $table->timestamps();
        });

        Schema::table('notification_users', function (Blueprint $table){
            $table->foreign('id_notification')->references('id')->on('notifications')->onDelete('cascade');
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_users');
    }
};
