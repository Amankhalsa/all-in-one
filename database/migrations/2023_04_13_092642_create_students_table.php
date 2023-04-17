<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('sname')->nullable();
            $table->string('fname')->nullable();
            $table->string('class')->nullable();
            $table->string('roll')->nullable();
            $table->string('dob')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('students');
    }
};
