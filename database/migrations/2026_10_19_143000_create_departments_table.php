<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('is_executive')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('color')->default('red');
            $table->timestamps();
        });

        Schema::table('team_members', function (Blueprint $table) {
            $table->foreignId('department_id')->nullable()->after('position')->constrained('departments')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
        Schema::dropIfExists('departments');
    }
};
