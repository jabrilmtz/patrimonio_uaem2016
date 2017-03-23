<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramsTypesTableSeeder extends Seeder
{
    /**
     * Archivo para generar registros de prueba
     *
     * @return void
     */
    public function run()
    {
        // Se comienzan a agregar los registros

        //      C I E N C I A S     A G R O P E C U A R I A S
        DB::table('programs')->insert([
            'name' => 'Ingeniería en Desarrollo rural',
            'branch' => 'Ciencias Agropecuarias',
            'modality' => 'Escolarizada',
            'description' => 'Formar profesionistas capaces de generar y/o participar en procesos de desarrollo rural 
                              que incidan en la transformación del campo en los diferentes escenarios con una visión 
                              crítica, científica, sustentable y de respeto a la diversidad cultural.',
        ]);
        DB::table('programs')->insert([
            'name' => 'Ingeniería en Fitosanidad',
            'branch' => 'Ciencias Agropecuarias',
            'modality' => 'Escolarizada',
            'description' => 'Formar profesionales líderes con capacidades y competencias para desarrollar, validar y 
                              transferir alternativas y estrategias sustentables de protección vegetal en los sistemas 
                              de producción agrícola del ámbito local, regional, nacional e internacional. ',
        ]);
        DB::table('programs')->insert([
            'name' => 'Ingeniería Hortícola',
            'branch' => 'Ciencias Agropecuarias',
            'modality' => 'Escolarizada',
            'description' => 'Formar profesionales que sean capaces de interpretar y transformar la realidad del sector 
                              hortícola interviniendo en las cadenas productivas mediante la aplicación de métodos y 
                              técnicas con énfasis en la certificación de productos orgánicos e incidiendo en el 
                              desarrollo empresarial, social y privado del área con enfoques integrales y sustentables.',
        ]);
        DB::table('programs')->insert([
            'name' => 'Ingeniería en Producción animal',
            'branch' => 'Ciencias Agropecuarias',
            'modality' => 'Escolarizada',
            'description' => 'Formar profesionales con capacidad científico tecnológica para dar alternativas 
                              pertinentes de solución a los problemas de la producción animal desde un enfoque holístico 
                              mediante métodos vivenciales, con técnicas cualitativas y cuantitativas en beneficio de 
                              los productores, sus familias y entornos.',
        ]);
        DB::table('programs')->insert([
            'name' => 'Ingeniería en Producción vegetal',
            'branch' => 'Ciencias Agropecuarias',
            'modality' => 'Escolarizada',
            'description' => 'Formar líderes profesionales en producción vegetal con una sólida preparación académica 
                              científico-práctica, con capacidades y habilidades para realizar investigación y 
                              desarrollo enfocados a resolver el rezago tecnológico del sector agrícola, integrando de 
                              manera sustentable los recursos naturales, insumos y tecnologías.',
        ]);


        //      C I E N C I A S    N A T U R A L E S
        DB::table('programs')->insert([
            'name' => 'Licenciatura en Biología',
            'branch' => 'Ciencias Naturales',
            'modality' => 'Escolarizada',
            'description' => 'Preparar profesionales de la Biología con capacidad analítica y de aplicación del método 
                              científico en los diferentes niveles de organización biológica, que le permita solucionar 
                              problemas teóricos de forma inter y multidisciplinaria.',
        ]);
        DB::table('programs')->insert([
            'name' => 'Licenciatura en Ciencias Ambientales',
            'branch' => 'Ciencias Naturales',
            'modality' => 'Escolarizada',
            'description' => 'Formar recursos humanos bajo un enfoque integral e interdisciplinario con conocimientos 
                              conceptuales e instrumentales para la comprensión y el análisis del ambiente considerando 
                              sus aspectos físicos, biológicos y sociales; capaces de proponer alternativas para el 
                              diagnóstico, la prevención y remediación de la problemática ambiental.',
        ]);
    }
}
