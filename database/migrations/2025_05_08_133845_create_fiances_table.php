<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fiances', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenoms');
            $table->enum('sexe', ['M', 'F']);
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('ethnie')->nullable();
            $table->string('contact');
            $table->string('eglise')->nullable();
            $table->string('tribu')->nullable();
            $table->string('departement')->nullable();
            $table->string('profession')->nullable();
            $table->string('nom_entreprise')->nullable();
            $table->string('commune_entreprise')->nullable();
            $table->string('domicile')->nullable();
            $table->string('statut_habitation')->nullable();
            $table->integer('nombre_enfants')->default(0);
            $table->integer('personnes_en_charge')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fiances');
    }
};