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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('instagram')->nullable();
            $table->date('birthday');
            $table->double('mediaRating')->nullable()->default('0');
            $table->unsignedBigInteger('id_usersTypes');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table){
            $table->foreign('id_usersTypes')->references('id')->on('usersTypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
