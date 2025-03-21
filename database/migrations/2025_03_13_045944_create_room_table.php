<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->id('room_id');
            $table->string('image');
            $table->text('tag');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('room');
    }
};
