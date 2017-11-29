<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeArchiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archive', function (Blueprint $table) {
    $table->text('description')->default('desctiption goes here');
    $table->string('slug')->default('photo1');
    $table->string('image')->default('img1');
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
        Schema::table('archive', function (Blueprint $table) {
            //
        });
    }
}
