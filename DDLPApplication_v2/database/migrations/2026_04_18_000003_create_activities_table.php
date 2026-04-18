<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->text('description');
            $table->string('lieu');
            $table->date('date');
            $table->string('attachment');

            // Champs de performance / évaluation
            $table->integer('beneficiaries_expected')->nullable();
            $table->integer('beneficiaries_actual')->nullable();
            $table->decimal('budget_expected', 10, 2)->nullable();
            $table->decimal('budget_actual', 10, 2)->nullable();
            $table->date('actual_date')->nullable();

            $table->string('evaluation_status')->default('en_attente'); // Enum EvaluationStatus
            $table->text('evaluation_comment')->nullable();
            $table->float('score')->nullable();
            $table->boolean('is_visible')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
