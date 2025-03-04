<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id('blog_id');
            $table->string('image');
            $table->text('tag');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('Admin_name');
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('blog');
    }
};
