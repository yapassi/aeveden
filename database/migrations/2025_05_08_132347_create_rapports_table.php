<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coaching_id')->constrained('coachings');
            $table->string('mois');
            $table->integer('nombre_seances');
            
            // Champ pour les types de séances (stocké en JSON)
            $table->json('types_seances')->comment('Types possibles: cours, priere, exhortation, autre');
            
            $table->string('derniere_lecon');
            $table->text('observations')->nullable();
            $table->text('défis_couple')->nullable();
            $table->text('solutions_coaches')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rapports');
    }
};
