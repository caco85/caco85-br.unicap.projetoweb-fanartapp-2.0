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
        Schema::create('fanarts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('image');
            $table->double('mediaRating')->nullable();
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_fanartCategories');
            $table->timestamps();
        });
        Schema::table('fanarts', function (Blueprint $table){
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_fanartCategories')->references('id')->on('fanartCategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fanarts');
    }
};
