<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->id('about_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('Rooms');
            $table->string('Staffs');
            $table->string('Clients');
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('about');
    }
};
