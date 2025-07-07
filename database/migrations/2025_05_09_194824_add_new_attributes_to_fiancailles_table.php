<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fiancailles', function (Blueprint $table) {
            $table->date('date_dot')->nullable()->after('date_debut')
                ->comment('Date de la cérémonie de dot');
            
            $table->date('date_mariage')->nullable()->after('date_dot')
                ->comment('Date du mariage officiel');
            
            $table->enum('vie_ensemble', ['oui', 'non'])->default('non')
                ->after('date_mariage')
                ->comment('Vivent-ils ensemble actuellement ?');
            
            $table->enum('etape', [
                'amitié', 
                'kokoko_fait', 
                'dot_faite', 
                'mariage_civil_fait'
            ])->default('amitié')
              ->after('vie_ensemble')
              ->comment('Étape actuelle dans le processus');
        });
    }

    public function down()
    {
        Schema::table('fiancailles', function (Blueprint $table) {
            $table->dropColumn([
                'date_dot',
                'date_mariage',
                'vie_ensemble',
                'etape'
            ]);
        });
    }
};