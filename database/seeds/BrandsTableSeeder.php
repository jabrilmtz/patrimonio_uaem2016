<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Se generan registros de base
     *
     * @return void
     */
    public function run()
    {
        // Se genera una variable de tipo "faker" para poder generar variables aleatorias
        $faker = Faker\Factory::create();

        // Se comienzan a agregar uno por uno los 10 registros
        $i = 0;
        for ($i=0; $i<10; $i++){
            // Se asignan los valores al nuevo registro
            DB::table('brands')->insert([
                'name' => $faker->company,
            ]);
        }
    }
}
