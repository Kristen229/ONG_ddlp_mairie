<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Informations générales
            $table->string('group'); // association ou ong (Enum UserGroup)
            $table->string('name');
            $table->string('domaine');
            $table->string('denomination');
            $table->date('date');
            $table->string('objectif1');
            $table->string('objectif2');
            $table->string('objectif3');

            // Coordonnées
            $table->string('siege')->default('Non spécifié');
            $table->string('email')->nullable();
            $table->string('number1')->default('Non spécifié');
            $table->string('number2')->default('Non spécifié');
            $table->string('attachment')->default('Non spécifié'); // logo
            $table->string('identifiant')->default('Non spécifié');
            $table->string('password')->nullable();
            $table->string('lien')->default('Non spécifié');

            // Bureau exécutif (snake_case)
            $table->string('name_president')->default('Non spécifié');
            $table->string('last_name_president')->default('Non spécifié');
            $table->string('attachment1')->default('Non spécifié');

            $table->string('name_vice_president')->default('Non spécifié');
            $table->string('last_name_vice_president')->default('Non spécifié');
            $table->string('attachment2')->default('Non spécifié');

            $table->string('name_secretaire_general')->default('Non spécifié');
            $table->string('last_name_secretaire_general')->default('Non spécifié');
            $table->string('attachment3')->default('Non spécifié');

            $table->string('name_tresorier_general')->default('Non spécifié');
            $table->string('last_name_tresorier_general')->default('Non spécifié');
            $table->string('attachment4')->default('Non spécifié');

            $table->string('attachment5')->default('Non spécifié'); // couverture
            $table->string('signature_data')->nullable();
            $table->string('cachet')->nullable();

            // Métadonnées
            $table->string('created_by')->default('user'); // 'user' ou 'admin'
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
