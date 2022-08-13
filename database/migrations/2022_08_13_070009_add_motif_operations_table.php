<?php

/**
 *  Author  :       Jean Lionel
 *  Date    :       13/8/2022
 *  Addresse:       Rumonge       
 * 
 * 
 **/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMotifOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operations', function (Blueprint $table) {
            //CODE ECRIT A RUMONGE Le 13/8/2022
            $table->text("motif")->after("operer_par")->nullable();
            $table->string("piece_number")->after("cni")->nullable();
        });

        Schema::table('operation_caisses', function (Blueprint $table) {
            //``, `type_operation`, `operer_par`, `cni`

            $table->double('montant_restant', 64,4)->after("montant");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operations', function (Blueprint $table) {
            //
            $table->dropColumn('montant_restant');
        }); 
        Schema::table('operations', function (Blueprint $table) {
            //
            $table->dropColumn('motif');
            $table->dropColumn('piece_number');
        });
    }
}
