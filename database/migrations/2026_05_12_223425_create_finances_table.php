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
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->string('type_flux');
            $table->decimal('amount', 12, 2);
            $table->foreignId('commission_id')->nullable()->constrained()->nullOnDelete();
            $table->string('justificatif_path')->nullable();
            $table->string('source')->nullable();
            $table->timestamp('recorded_at')->useCurrent();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
