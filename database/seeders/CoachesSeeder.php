<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CoachesSeeder extends Seeder
{
    public function run()
    {
        $coachesHommes = [
            [
                'nom' => 'Konan',
                'prenoms' => 'Jean',
                'email' => 'jean.konan@eden1eav.com',
                'contact' => '+2250701010101',
            ],
            [
                'nom' => 'Kouassi',
                'prenoms' => 'Paul',
                'email' => 'paul.kouassi@eden1eav.com',
                'contact' => '+2250702020202',
            ],
            [
                'nom' => 'Yao',
                'prenoms' => 'Marc',
                'email' => 'marc.yao@eden1eav.com',
                'contact' => '+2250703030303',
            ],
            [
                'nom' => 'Koffi',
                'prenoms' => 'Pierre',
                'email' => 'pierre.koffi@eden1eav.com',
                'contact' => '+2250704040404',
            ],
            [
                'nom' => 'Diabaté',
                'prenoms' => 'Jacques',
                'email' => 'jacques.diabate@eden1eav.com',
                'contact' => '+2250705050505',
            ],
        ];

        $coachesFemmes = [
            [
                'nom' => 'Koné',
                'prenoms' => 'Marie',
                'email' => 'marie.kone@eden1eav.com',
                'contact' => '+2250706060606',
            ],
            [
                'nom' => 'Yao',
                'prenoms' => 'Alice',
                'email' => 'alice.yao@eden1eav.com',
                'contact' => '+2250707070707',
            ],
            [
                'nom' => 'Kouamé',
                'prenoms' => 'Julie',
                'email' => 'julie.kouame@eden1eav.com',
                'contact' => '+2250708080808',
            ],
            [
                'nom' => 'Bamba',
                'prenoms' => 'Sophie',
                'email' => 'sophie.bamba@eden1eav.com',
                'contact' => '+2250709090909',
            ],
            [
                'nom' => 'Traoré',
                'prenoms' => 'Anne',
                'email' => 'anne.traore@eden1eav.com',
                'contact' => '+2250701010100',
            ],
        ];

        // Création des coachs hommes
        foreach ($coachesHommes as $coach) {
            User::create([
                'nom' => $coach['nom'],
                'prenoms' => $coach['prenoms'],
                'sexe' => 'M',
                'email' => $coach['email'],
                'contact' => $coach['contact'],
                'password' => Hash::make('password'), // Mot de passe par défaut
                'role' => 'coach',
                'email_verified_at' => now(),
            ]);
        }

        // Création des coachs femmes
        foreach ($coachesFemmes as $coach) {
            User::create([
                'nom' => $coach['nom'],
                'prenoms' => $coach['prenoms'],
                'sexe' => 'F',
                'email' => $coach['email'],
                'contact' => $coach['contact'],
                'password' => Hash::make('password'), // Mot de passe par défaut
                'role' => 'coach',
                'email_verified_at' => now(),
            ]);
        }

        $this->command->info('10 coachs (5 hommes et 5 femmes) ont été créés avec succès!');
    }
}