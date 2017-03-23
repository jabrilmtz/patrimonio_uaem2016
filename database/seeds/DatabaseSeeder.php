<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Archivo principal de los "seeders"
     *
     * @return void
     */
    public function run()
    {
        // Se mandan a traer uno por uno los seeders de cada clase
        $this->call(AssetsTypesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(IncidencesTypesTableSeeder::class);
        $this->call(ProgramsTypesTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
    }
}
