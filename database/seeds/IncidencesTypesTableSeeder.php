<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidencesTypesTableSeeder extends Seeder
{
    /**
     * Se agregan registros de prueba
     *
     * @return void
     */
    public function run()
    {
        DB::table('incidences_types')->insert([
            'name' => 'Usabilidad',
        ]);
        DB::table('incidences_types')->insert([
            'name' => 'Defecto',
        ]);
        DB::table('incidences_types')->insert([
            'name' => 'Localización',
        ]);
    }
}
