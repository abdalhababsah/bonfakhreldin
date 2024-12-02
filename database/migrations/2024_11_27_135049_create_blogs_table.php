<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('content_en');
            $table->text('content_ar');
            $table->string('meta_description_en')->nullable();
            $table->string('meta_description_ar')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->timestamps();
            $table->enum('status', ['published', 'draft'])->default('draft');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}