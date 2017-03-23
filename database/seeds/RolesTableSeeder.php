<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Se generan los primeros registros de la tabla
     *
     * @return void
     */
    public function run()
    {
        // Se agregan los roles de usuario con su información
        DB::table('roles')->insert([
            'name' => 'Administrador',
        ]);
        DB::table('roles')->insert([
            'name' => 'Normal',
        ]);
    }
}
