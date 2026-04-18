<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->integer('beneficiaries_expected')->nullable();
            $table->integer('beneficiaries_actual')->nullable();

            $table->decimal('budget_expected', 10, 2)->nullable();
            $table->decimal('budget_actual', 10, 2)->nullable();

            $table->date('planned_date')->nullable();
            $table->date('actual_date')->nullable();

            $table->enum('evaluation_status', [
                'en_attente',
                'conforme',
                'non_conforme',
                'avertissement'
            ])->default('en_attente');

            $table->text('evaluation_comment')->nullable();

            $table->float('score')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {

            $table->dropColumn([
                'beneficiaries_expected',
                'beneficiaries_actual',
                'budget_expected',
                'budget_actual',
                'planned_date',
                'actual_date',
                'evaluation_status',
                'evaluation_comment',
                'score'
            ]);

        });
    }

};
