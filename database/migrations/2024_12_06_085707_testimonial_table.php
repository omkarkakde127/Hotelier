<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('testimonial', function (Blueprint $table) {
            $table->id('testimonial_id');
            $table->string('image');
            $table->string('description');
            $table->string('name');
            $table->text('profession')->nullable();
           
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('testimonial');
    }
};
