<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('couple_coachs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_homme_id')->constrained('users');
            $table->foreignId('coach_femme_id')->constrained('users');
            $table->string('domicile');
            $table->date('date_mariage');
            $table->date('date_debut_coaching')->nullable();
            $table->timestamps();

            // Contrainte : un coach ne peut participer qu'à un seul couple
            $table->unique(['coach_homme_id']);
            $table->unique(['coach_femme_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('couple_coachs');
    }
};