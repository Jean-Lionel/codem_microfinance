<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirementHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virement_histories', function (Blueprint $table) {
            $table->id();
            $table->string("compte_debuteur");
            $table->string("compte_beneficiary");
            $table->double("montant", 64,2);
            $table->foreignId("user_id");
            $table->text("motif")->nullable();
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
        Schema::dropIfExists('virement_histories');
    }
}
