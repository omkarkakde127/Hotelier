<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('luxury', function (Blueprint $table) {
            $table->id('luxury_id');
            $table->string('image');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('luxury');
    }
};
