<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('rapports', function (Blueprint $table) {
            // Renommer le champ mois en date_de_creation
            $table->timestamp('date_de_creation')
                  ->nullable()
                  ->after('coaching_id');
            
            // Si vous voulez conserver les données existantes
            // Vous pouvez ajouter une logique de conversion ici
            // Par exemple, convertir les valeurs de mois en dates valides
        });

        // Conversion des données existantes (optionnel)
        \DB::statement('UPDATE rapports SET date_de_creation = NOW() WHERE date_de_creation IS NULL');
        
        // Supprimer l'ancien champ après conversion
        Schema::table('rapports', function (Blueprint $table) {
            $table->dropColumn('mois');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('rapports', function (Blueprint $table) {
            // Recréer l'ancien champ
            $table->string('mois')->nullable()->after('coaching_id');
        });

        // Si vous voulez restaurer les données (approximation)
        \DB::statement('UPDATE rapports SET mois = DATE_FORMAT(date_de_creation, "%Y-%m") WHERE mois IS NULL');
        
        // Supprimer le nouveau champ
        Schema::table('rapports', function (Blueprint $table) {
            $table->dropColumn('date_de_creation');
        });
    }
};