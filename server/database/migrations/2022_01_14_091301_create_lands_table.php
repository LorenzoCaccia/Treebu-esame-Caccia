<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->string("comune")->nullable();
            $table->string("foto")->nullable();
            $table->float("dimensione")->nullable();
            $table->string("foglio_catastale")->nullable();
            $table->string("mappale_catastale")->nullable();
            $table->string("parcella_catastale")->nullable();
            $table->string("tipo_terreno")->nullable();
            $table->string("tipo_irrigazione")->nullable();
            $table->string("tipo_offerta")->nullable();
            $table->double("canone_offerta")->nullable();
            $table->boolean("disponibile")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lands');
    }
}
