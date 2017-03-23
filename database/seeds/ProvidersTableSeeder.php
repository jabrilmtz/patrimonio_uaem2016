<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Se agregan unos registros de prueba a la clase
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
            // Se genera un nombre de compañia aleatoriamente
            $name = $faker->company;
            // Se asignan los valores al nuevo registro
            DB::table('providers')->insert([
                'name' => $name,
                'code' => str_random(7),
                'email' => $name.'@gmail.com',
            ]);
        }
    }
}
