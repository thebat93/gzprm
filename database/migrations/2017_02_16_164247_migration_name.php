<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archive', function (Blueprint $table) {
	//$table->decimal('price', 10, 2)->change();
    $table->text('description');
    $table->string('slug')->unique();
    $table->string('image')->unique();
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
            Schema::drop('archive');
        });
    }
}
