<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyPokemonListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_pokemon_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('image')->default('');
            $table->string('type')->default('');
            $table->string('abilities')->default('');
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
        Schema::dropIfExists('my_pokemon_lists');
    }
}
