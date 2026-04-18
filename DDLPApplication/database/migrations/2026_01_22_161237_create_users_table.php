<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('groupe');
            $table->string('name');
            $table->string('domaine');
            $table->string('denomination');
            $table->date('date');
            $table->string('objectif1');
            $table->string('objectif2');
            $table->string('objectif3');
            
            $table->string('siege')->default('Non spécifié');
            $table->string('email')->nullable();

            $table->string('number1')->default('Non spécifié');
            $table->string('number2')->default('Non spécifié');
            $table->string('attachment')->default('Non spécifié');
            $table->string('identifiant')->default('Non spécifié');
            $table->string('password')->nullable();


            $table->string('lien')->default('Non spécifié');

            $table->string('namePresident')->default('Non spécifié');
            $table->string('lastNamePresident')->default('Non spécifié');
            $table->string('attachment1')->default('Non spécifié');
            $table->string('nameVicePresident')->default('Non spécifié');
            $table->string('lastNameVicePresident')->default('Non spécifié');
            $table->string('attachment2')->default('Non spécifié');
            $table->string('nameSecretaireGeneral')->default('Non spécifié');
            $table->string('lastNameSecretaireGeneral')->default('Non spécifié');
            $table->string('attachment3')->default('Non spécifié');
            $table->string('nameTresorierGeneral')->default('Non spécifié');
            $table->string('lastNameTresorierGeneral')->default('Non spécifié');
            $table->string('attachment4')->default('Non spécifié');
            $table->string('attachment5')->default('Non spécifié');
            $table->string('signature_data')->nullable(); 
            $table->string('cachet')->nullable(); 

            $table->string('created_by')->default('user'); // 'user' ou 'admin'
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
