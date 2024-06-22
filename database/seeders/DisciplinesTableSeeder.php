<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisciplinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disciplines = [
            'Mathématiques',
            'Physique',
            'Chimie',
            'Biologie',
            'Informatique',
            'Langues',
            'Sciences sociales',
            'Arts',
            'Droit',
            'Économie et gestion',
            'Psychologie',
            'Sociologie',
            'Anthropologie',
            'Philosophie',
            'Religion et théologie',
        ];

        foreach ($disciplines as $discipline) {
            DB::table('disciplines')->insert([
                'discipline' => $discipline,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
