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
            $table->string('role')->default('member');
            $table->foreignId('commission_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('points_motivation')->default(0);
            $table->string('school')->nullable();
            $table->string('member_code')->nullable()->unique();
            $table->string('avatar_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['commission_id']);
            $table->dropColumn(['role', 'commission_id', 'points_motivation', 'school', 'member_code', 'avatar_path']);
        });
    }
};
