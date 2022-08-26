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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->enum('star',['1','2','3','4','5']);
            $table->enum('status',['pending','approved']);
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_fanart');
            $table->timestamps();
        });
        Schema::table('evaluations', function (Blueprint $table){
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_fanart')->references('id')->on('fanarts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
};
