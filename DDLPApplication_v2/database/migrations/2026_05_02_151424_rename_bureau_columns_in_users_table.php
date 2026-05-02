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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('namePresident', 'name_president');
            $table->renameColumn('lastNamePresident', 'last_name_president');
            $table->renameColumn('nameVicePresident', 'name_vice_president');
            $table->renameColumn('lastNameVicePresident', 'last_name_vice_president');
            $table->renameColumn('nameSecretaireGeneral', 'name_secretaire_general');
            $table->renameColumn('lastNameSecretaireGeneral', 'last_name_secretaire_general');
            $table->renameColumn('nameTresorierGeneral', 'name_tresorier_general');
            $table->renameColumn('lastNameTresorierGeneral', 'last_name_tresorier_general');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name_president', 'namePresident');
            $table->renameColumn('last_name_president', 'lastNamePresident');
            $table->renameColumn('name_vice_president', 'nameVicePresident');
            $table->renameColumn('last_name_vice_president', 'lastNameVicePresident');
            $table->renameColumn('name_secretaire_general', 'nameSecretaireGeneral');
            $table->renameColumn('last_name_secretaire_general', 'lastNameSecretaireGeneral');
            $table->renameColumn('name_tresorier_general', 'nameTresorierGeneral');
            $table->renameColumn('last_name_tresorier_general', 'lastNameTresorierGeneral');
        });
    }
};
