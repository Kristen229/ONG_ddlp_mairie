<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('is_visible');
            $table->unsignedTinyInteger('correction_count')->default(0)->after('status');
            $table->text('last_admin_feedback')->nullable()->after('correction_count');
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['status', 'correction_count', 'last_admin_feedback']);
        });
    }
};
