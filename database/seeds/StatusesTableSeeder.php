<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Se agregan los 3 tipos de estados que puede tener un bien
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'Normal',
        ]);
        DB::table('statuses')->insert([
            'name' => 'Pre-registrado',
        ]);
        DB::table('statuses')->insert([
            'name' => 'Sobrante',
        ]);
    }
}
