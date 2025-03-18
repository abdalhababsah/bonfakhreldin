<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 30)->nullable();
            $table->text('message');
            $table->timestamps();
            $table->enum('status', ['new', 'in-progress', 'resolved'])->default('new');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}