<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::truncate();

        Role::create([
        	'name' => 'ADMIN'
        ]);

         Role::create([
        	'name' => 'VERSEMENT'

        ]);

         Role::create([
        	'name' => 'RETRAIT'

        ]);

        Role::create([
            'name' => 'ENREGISTREMENT DES CLIENTS'

        ]);


        Role::create([
            'name' => 'PAIEMENT DES INTERET SUR LES PLACEMENT'

        ]);

        Role::create([
            'name' => 'GESTION DES DECOUVERTS'

        ]);
        Role::create([
            'name' => 'GESTION DES PLACEMENTS'

        ]);
        
    }
}
