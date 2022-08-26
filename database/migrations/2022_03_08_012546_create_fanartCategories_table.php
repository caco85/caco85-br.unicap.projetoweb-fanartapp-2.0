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
        Schema::create('fanartCategories', function (Blueprint $table) {
            $table->id();
            $table->enum('nameCategory',['Anime','Cartoon','Free','Game','HQ','Mangá','Manhaus','Movie','Series','SciFi']);
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
        Schema::dropIfExists('fanartCategories');
    }
};
