<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetsTypesTableSeeder extends Seeder
{
    /**
     * Se agregan los registros de prueba o base
     *
     * @return void
     */
    public function run()
    {
        //          T I P O S   D E     A C T I V O S
        // III.   Mobiliario y equipo de oficina.
        DB::table('assets_types')->insert([
            'name' => 'Mobiliario y equipo de oficina',
            'percentage' => '10',
            'useful_life' => '10',
        ]);
        // VI.    Automóviles, autobuses, camiones de carga, tracto-camiones, montacargas y remolques.
        DB::table('assets_types')->insert([
            'name' => 'Automóviles, autobuses, camiones de carga',
            'percentage' => '25',
            'useful_life' => '4',
        ]);
        // VII.   Computadoras personales de escritorio y portátiles; servidores; impresoras, lectores ópticos,
        // graficadores, lectores de código de barras, digitalizadores, unidades de almacenamiento externo y
        // concentradores de redes de cómputo.
    DB::table('assets_types')->insert([
            'name' => 'Computadoras de escritorio y portátiles',
            'percentage' => '30',
            'useful_life' => '3.3',
        ]);
        DB::table('assets_types')->insert([
            'name' => 'Servidores',
            'percentage' => '30',
            'useful_life' => '3.3',
        ]);
        DB::table('assets_types')->insert([
            'name' => 'Impresoras, lectores ópticos, graficadores',
            'percentage' => '30',
            'useful_life' => '3.3',
        ]);
        DB::table('assets_types')->insert([
            'name' => 'Lectores de código de barras, digitalizadores',
            'percentage' => '30',
            'useful_life' => '3.3',
        ]);
        DB::table('assets_types')->insert([
            'name' => 'Unidades de almacenamiento externo y concentradores de redes de cómputo',
            'percentage' => '30',
            'useful_life' => '3.3',
        ]);
        // VIII.   Dados, troqueles, moldes, matrices y herramental.
        DB::table('assets_types')->insert([
            'name' => 'Dados, troqueles, moldes, matrices y herramental',
            'percentage' => '35',
            'useful_life' => '3',
        ]);
        // IX. Semovientes, vegetales, máquinas registradoras de comprobación y equipos electrónicos de registro fiscal.
        DB::table('assets_types')->insert([
            'name' => 'Semovientes, vegetales',
            'percentage' => '100',
            'useful_life' => '1',
        ]);
        DB::table('assets_types')->insert([
            'name' => 'Máquinas registradoras de comprobación fiscal y equipos electrónicos de registro fiscal',
            'percentage' => '100',
            'useful_life' => '1',
        ]);
        // X.    Tratándose de comunicaciones telefónicas:
        DB::table('assets_types')->insert([
            'name' => 'Torres de transmisión y cables',
            'percentage' => '5',
            'useful_life' => '20',
        ]);
        DB::table('assets_types')->insert([
            'name' => 'Sistemas de radio',
            'percentage' => '8',
            'useful_life' => '12.5',
        ]);
        DB::table('assets_types')->insert([
            'name' => 'Equipo utilizado en la transmisión',
            'percentage' => '10',
            'useful_life' => '10',
        ]);
        DB::table('assets_types')->insert([
            'name' => 'Equipo de la central telefónica',
            'percentage' => '25',
            'useful_life' => '4',
        ]);
        DB::table('assets_types')->insert([
            'name' => 'Extra en comunicaciones telefónicas',
            'percentage' => '10',
            'useful_life' => '10',
        ]);
        // XI.    Tratándose de comunicaciones satelitales:
        DB::table('assets_types')->insert([
            'name' => 'Segmento satelital en el espacio',
            'percentage' => '8',
            'useful_life' => '12.5',
        ]);
        DB::table('assets_types')->insert([
            'name' => 'Segmento satelital en tierra',
            'percentage' => '10',
            'useful_life' => '10',
        ]);
        // XII.   Maquinaria y equipo para la generación de energía proveniente de fuentes renovables.
        DB::table('assets_types')->insert([
            'name' => 'Maquinaria y equipo para la generación de energía proveniente de fuentes renovables',
            'percentage' => '100',
            'useful_life' => '1',
        ]);
    }
}
