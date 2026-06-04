<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('domaine_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domaine_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['domaine_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domaine_user');
    }
};
