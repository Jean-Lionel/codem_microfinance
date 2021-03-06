<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenuCompteurWatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenu_compteur_watches', function (Blueprint $table) {
            $table->id();
            $table->double("montant",64,4);
            $table->boolean("status")->nullable();
            $table->text("comptes_error")->null();
            $table->text("comptes_success")->null();
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
        Schema::dropIfExists('tenu_compteur_watches');
    }
}
