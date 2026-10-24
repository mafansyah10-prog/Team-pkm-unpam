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
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('status', 30)->default('pending')->after('is_read');
            $table->text('resolution_notes')->nullable()->after('status');
            $table->timestamp('resolved_at')->nullable()->after('resolution_notes');
            $table->string('handled_by')->nullable()->after('resolved_at');
            $table->string('deleted_reason')->nullable()->after('handled_by');
            $table->timestamp('deleted_at')->nullable()->after('deleted_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'resolution_notes',
                'resolved_at',
                'handled_by',
                'deleted_reason',
                'deleted_at',
            ]);
        });
    }
};
