<?php

namespace Database\Seeders;

use App\Models\Fiance;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FianceSeeder extends Seeder
{
    public function run()
    {
        $ethnies = ['Baoulé', 'Bété', 'Senoufo', 'Malinké', 'Agni', 'Yacouba', 'Guéré', 'Dida', 'Attié', 'Ebrié'];
        $eglises = ['Béthel', 'Sion', 'Salem', 'Catholique', 'Protestante', 'Pentecôtiste', 'Adventiste', 'Assemblée de Dieu'];
        $tribus = ['Akan', 'Krou', 'Mandé', 'Gur', 'Kwa'];
        $departements = ['Abidjan', 'Yamoussoukro', 'Bouaké', 'San Pedro', 'Korhogo', 'Man', 'Gagnoa', 'Daloa'];
        $professions = ['Ingénieur', 'Médecin', 'Enseignant', 'Commerçant', 'Fonctionnaire', 'Agriculteur', 'Artisan', 'Infirmier'];
        $statutsHabitation = ['Propriétaire', 'Locataire', 'En famille', 'Hébergé'];

        // Hommes
        $hommes = [
            ['nom' => 'Kouassi', 'prenoms' => 'Jean'],
            ['nom' => 'Konan', 'prenoms' => 'Pierre'],
            ['nom' => 'Yao', 'prenoms' => 'Serge'],
            ['nom' => 'Koffi', 'prenoms' => 'André'],
            ['nom' => 'Kouame', 'prenoms' => 'Bernard'],
            ['nom' => 'N\'Guessan', 'prenoms' => 'Alain'],
            ['nom' => 'Amani', 'prenoms' => 'Michel'],
            ['nom' => 'Soro', 'prenoms' => 'Jacques'],
            ['nom' => 'Diabate', 'prenoms' => 'Moussa'],
            ['nom' => 'Traore', 'prenoms' => 'Bakary']
        ];

        // Femmes
        $femmes = [
            ['nom' => 'Kouadio', 'prenoms' => 'Aminata'],
            ['nom' => 'Koné', 'prenoms' => 'Fatou'],
            ['nom' => 'Yao', 'prenoms' => 'Aïcha'],
            ['nom' => 'Koffi', 'prenoms' => 'Mariam'],
            ['nom' => 'Kouame', 'prenoms' => 'Adjoua'],
            ['nom' => 'N\'Guessan', 'prenoms' => 'Affoué'],
            ['nom' => 'Amani', 'prenoms' => 'Bintou'],
            ['nom' => 'Soro', 'prenoms' => 'Djeneba'],
            ['nom' => 'Diabate', 'prenoms' => 'Kadiatou'],
            ['nom' => 'Traore', 'prenoms' => 'Ramatoulaye']
        ];

        // Création des hommes
        foreach ($hommes as $homme) {
            Fiance::create([
                'nom' => $homme['nom'],
                'prenoms' => $homme['prenoms'],
                'sexe' => 'M',
                'email' => strtolower($homme['prenoms']) . '.' . strtolower($homme['nom']) . '@example.com',
                'date_naissance' => Carbon::now()->subYears(rand(20, 40))->subMonths(rand(1, 12))->subDays(rand(1, 28)),
                'lieu_naissance' => 'Abidjan',
                'ethnie' => $ethnies[array_rand($ethnies)],
                'contact' => '07' . rand(50, 89) . rand(100000, 999999),
                'eglise' => $eglises[array_rand($eglises)],
                'tribu' => $tribus[array_rand($tribus)],
                'departement' => $departements[array_rand($departements)],
                'profession' => $professions[array_rand($professions)],
                'nom_entreprise' => 'Entreprise ' . $homme['prenoms'],
                'commune_entreprise' => 'Commune ' . rand(1, 10),
                'domicile' => 'Rue ' . $homme['nom'] . ', N°' . rand(1, 100),
                'statut_habitation' => $statutsHabitation[array_rand($statutsHabitation)],
                'nombre_enfants' => rand(0, 3),
                'personnes_en_charge' => rand(0, 5),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Création des femmes
        foreach ($femmes as $femme) {
            Fiance::create([
                'nom' => $femme['nom'],
                'prenoms' => $femme['prenoms'],
                'sexe' => 'F',
                'email' => strtolower($femme['prenoms']) . '.' . strtolower($femme['nom']) . '@example.com',
                'date_naissance' => Carbon::now()->subYears(rand(20, 35))->subMonths(rand(1, 12))->subDays(rand(1, 28)),
                'lieu_naissance' => 'Abidjan',
                'ethnie' => $ethnies[array_rand($ethnies)],
                'contact' => '07' . rand(50, 89) . rand(100000, 999999),
                'eglise' => $eglises[array_rand($eglises)],
                'tribu' => $tribus[array_rand($tribus)],
                'departement' => $departements[array_rand($departements)],
                'profession' => $professions[array_rand($professions)],
                'nom_entreprise' => 'Entreprise ' . $femme['prenoms'],
                'commune_entreprise' => 'Commune ' . rand(1, 10),
                'domicile' => 'Rue ' . $femme['nom'] . ', N°' . rand(1, 100),
                'statut_habitation' => $statutsHabitation[array_rand($statutsHabitation)],
                'nombre_enfants' => rand(0, 3),
                'personnes_en_charge' => rand(0, 5),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}