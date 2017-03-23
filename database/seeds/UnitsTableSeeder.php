<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsTableSeeder extends Seeder
{
    /**
     * Se agregan las unidades académicas de prueba
     *
     * @return void
     */
    public function run()
    {
        // Se genera una variable de tipo "faker" para poder generar variables aleatorias
        $faker = Faker\Factory::create();

        // Se obtienen el min y max de id en la tabla de empleados
        $employees = DB::table('employees')->select('id')->get();
        $min = $employees->min('id');
        $max = $employees->max('id');

        // Se comienzan a agregar los registros de unidades con su información

        //          UNIDADES EN CAMPUS NORTE
        DB::table('units')->insert([
            'name' => 'Escuela de Técnicos Laboratoristas',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Dirección de Educación Multimodal',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Facultad de Ciencias Agropecuarias',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Facultad de Ciencias Biológicas',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Centro de Investigación en Biotecnología (CEIB)',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Centro de Investigación en Biodiversidad y Conservación (CIByC)',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Centro de Investigaciones Biológicas (CIB)',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Facultad de Ciencias Químicas e Ingeniería',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Instituto de Investigación en Ciencias Básicas y Aplicadas',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Centro de Investigación en Ingeniería y Ciencias Aplicadas (CIICAP)',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Centro de Investigaciones Químicas (CIQ)',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Facultad de Contaduría, Administración e Informática',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Facultad de Derecho y Ciencias Sociales',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Facultad de Farmacia',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Facultad de Psicología',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Facultad de Humanidades',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Facultad de Arquitectura',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Facultad de Artes',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
        DB::table('units')->insert([
            'name' => 'Instituto de Ciencias de la Educación',
            'location' => 'Campus norte',
            'code' => str_random(7),
            'employee_id' => $faker->numberBetween($min, $max),
        ]);
    }
}
