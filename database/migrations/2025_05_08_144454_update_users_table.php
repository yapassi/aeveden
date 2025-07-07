<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer les anciennes colonnes si nécessaire
            $table->dropColumn(['name']); // Adaptez selon votre schéma actuel
            
            // Ajouter les nouvelles colonnes
            $table->string('nom')->after('id');
            $table->string('prenoms')->after('nom');
            $table->enum('sexe', ['M', 'F'])->after('prenoms');
            $table->string('contact')->after('sexe');
            $table->enum('role', ['admin', 'coach', 'manager'])->default('coach')->after('password');
            
            // Renommer email_verified_at si nécessaire
            $table->timestamp('email_verified_at')->nullable()->change();
            
            // Ajouter un index pour améliorer les performances
            $table->index(['role', 'sexe']);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Annuler les modifications si on rollback
            $table->dropColumn(['nom', 'prenoms', 'sexe', 'contact', 'role']);
            $table->string('name')->after('id');
            // Restaurer les autres champs si nécessaire
        });
    }
};