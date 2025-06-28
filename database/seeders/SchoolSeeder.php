<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            [
                'name' => 'Colegio Nacional San Martín',
                'slug' => 'colegio-nacional-san-martin',
                'primary_color' => '#2196F3',
                'secondary_color' => '#ffffff',
                'status' => 'active',
            ],
            [
                'name' => 'Instituto Simón Bolívar',
                'slug' => 'instituto-simon-bolivar',
                'primary_color' => '#4CAF50',
                'secondary_color' => '#ffffff',
                'status' => 'active',
            ],
            [
                'name' => 'Escuela José de San Martín',
                'slug' => 'escuela-jose-de-san-martin',
                'primary_color' => '#FF9800',
                'secondary_color' => '#ffffff',
                'status' => 'active',
            ],
            [
                'name' => 'Colegio Tecnológico Industrial',
                'slug' => 'colegio-tecnologico-industrial',
                'primary_color' => '#9C27B0',
                'secondary_color' => '#ffffff',
                'status' => 'active',
            ],
            [
                'name' => 'Instituto María Montessori',
                'slug' => 'instituto-maria-montessori',
                'primary_color' => '#E91E63',
                'secondary_color' => '#ffffff',
                'status' => 'active',
            ],
            [
                'name' => 'Colegio Santa Teresa',
                'slug' => 'colegio-santa-teresa',
                'primary_color' => '#795548',
                'secondary_color' => '#ffffff',
                'status' => 'active',
            ],
            [
                'name' => 'Instituto Técnico Nacional',
                'slug' => 'instituto-tecnico-nacional',
                'primary_color' => '#607D8B',
                'secondary_color' => '#ffffff',
                'status' => 'active',
            ],
            [
                'name' => 'Escuela Benito Juárez',
                'slug' => 'escuela-benito-juarez',
                'primary_color' => '#F44336',
                'secondary_color' => '#ffffff',
                'status' => 'active',
            ],
            [
                'name' => 'Colegio Americano Bilingüe',
                'slug' => 'colegio-americano-bilingue',
                'primary_color' => '#3F51B5',
                'secondary_color' => '#ffffff',
                'status' => 'active',
            ],
            [
                'name' => 'Instituto de Ciencias Aplicadas',
                'slug' => 'instituto-de-ciencias-aplicadas',
                'primary_color' => '#009688',
                'secondary_color' => '#ffffff',
                'status' => 'active',
            ],
        ];

        foreach ($schools as $school) {
            School::create($school);
        }
    }
}