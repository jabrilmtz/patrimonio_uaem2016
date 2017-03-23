<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Se generan 10 registros aleatorios en la clase
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
            // Se genera un nombre femenino o masculino aleatoriamente y un apellido
            $name = $faker->firstName($gender = null|'male'|'female');
            $surname = $faker->lastName;
            // Se asignan los valores al nuevo registro
            DB::table('employees')->insert([
                'name' => $name,
                'surname' => $surname,
                'code' => str_random(7),
                'email' => $name.$surname.'@gmail.com',
            ]);
        }
    }
}
