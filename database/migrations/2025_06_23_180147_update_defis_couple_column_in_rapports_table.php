<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Supprimer tous les anciens rapports
        DB::table('rapports')->truncate();

        // Modifier le champ `defis_couple` pour qu'il accepte un tableau JSON nullable
        Schema::table('rapports', function (Blueprint $table) {
            $table->json('defis_couple')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Revenir au type d'origine si besoin (ex: texte simple nullable)
        Schema::table('rapports', function (Blueprint $table) {
            $table->text('defis_couple')->nullable()->change();
        });
    }
};

