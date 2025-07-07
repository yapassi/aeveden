<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('coachings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiancailles_id')->constrained('fiancailles')->unique();
            $table->foreignId('couple_coach_id')->constrained('couple_coachs');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->enum('statut', ['actif', 'en_pause', 'arrete', 'acheve']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coachings');
    }
};