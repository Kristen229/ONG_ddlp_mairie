<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('association_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('type');
            $table->text('description');
            $table->enum('destinataire', [
                'Maire de la Commune de Cotonou',
                'Secretaire exécutif',
            ])->default('Maire de la Commune de Cotonou');
            $table->string('location');
            $table->string('status')->default('en_attente'); // Enum RequestStatus
            $table->string('pdf_path')->nullable();
            $table->string('reference')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('association_requests');
    }
};
