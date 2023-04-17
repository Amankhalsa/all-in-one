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
        Schema::table('blogs', function (Blueprint $table) {
            //
            $table->string('image')->after('description')->nullable();
            $table->string('address')->after('image')->nullable();
            $table->string('country')->after('address')->nullable();
            $table->string('gender')->after('country')->nullable();
            $table->string('hobies')->after('gender')->nullable();
            $table->string('profile')->after('hobies')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
            $table->dropColumn('image');
            $table->dropColumn('address');
            $table->dropColumn('country');
            $table->dropColumn('gender');
            $table->dropColumn('hobies');
            $table->dropColumn('profile');


        });
    }
};
