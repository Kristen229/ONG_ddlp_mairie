<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('association_requests', function (Blueprint $table) {
            $table->string('objet')->nullable()->after('reference');
            $table->string('attachment')->nullable()->after('pdf_path');
            $table->text('admin_response')->nullable()->after('attachment');
            $table->string('admin_attachment')->nullable()->after('admin_response');
            $table->timestamp('responded_at')->nullable()->after('admin_attachment');
        });
    }

    public function down(): void
    {
        Schema::table('association_requests', function (Blueprint $table) {
            $table->dropColumn(['objet', 'attachment', 'admin_response', 'admin_attachment', 'responded_at']);
        });
    }
};
