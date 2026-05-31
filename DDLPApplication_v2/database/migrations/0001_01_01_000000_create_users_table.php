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
            $table->string('groupe'); // ONG ou Association
            $table->string('name');
            $table->string('denomination');
            $table->date('date');
            $table->json('objectifs')->nullable(); // Stockage propre des 5 objectifs

            // Localisation
            $table->string('commune')->default('Cotonou');
            $table->string('arrondissement');
            $table->string('quartier');
            $table->string('maison');

            // Contacts
            $table->string('email')->unique()->nullable();
            $table->string('number1'); // Obligatoire
            $table->string('number2')->nullable(); // Optionnel
            $table->string('lien')->nullable(); // Optionnel

            // Fichiers Administratifs Obligatoires
            $table->string('logo_path')->nullable(); // Optionnel si admin crée
            $table->string('recepisse_path')->nullable();
            $table->string('journal_officiel_path')->nullable();
            $table->string('attestation_path')->nullable();
            $table->string('reglement_path')->nullable();

            // Identification
            $table->string('identifiant')->unique();
            $table->string('password')->nullable();

            // Métadonnées & Sécurité
            $table->string('created_by')->default('user'); // 'user' ou 'admin'
            $table->boolean('is_approved')->default(false);
            $table->boolean('must_change_password')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
