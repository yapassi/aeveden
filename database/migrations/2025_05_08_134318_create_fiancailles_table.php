<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fiancailles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiance_id')->constrained('fiances');
            $table->foreignId('fiancee_id')->constrained('fiances');
            $table->date('date_debut');
            $table->tinyInteger('note')->unsigned()->default(0)
                  ->comment('Note entre 0 et 5');
            $table->text('avis')->nullable();
            $table->date('date_fin')->nullable();
            $table->timestamps();

            // Contraintes d'unicité
            $table->unique(['fiance_id']);
            $table->unique(['fiancee_id']);
        });

        // Ajout de la contrainte CHECK via une requête SQL brute
        DB::statement('ALTER TABLE fiancailles ADD CONSTRAINT note_range_check CHECK (note >= 0 AND note <= 5)');
    }

    public function down()
    {
        Schema::dropIfExists('fiancailles');
    }
};