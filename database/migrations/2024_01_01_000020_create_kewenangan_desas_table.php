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
        Schema::create('kewenangan_desas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('desa_id')->constrained('master_desas')->cascadeOnDelete();
            $table->enum('level_akses', ['BACA', 'TULIS', 'PENUH'])->default('BACA');
            $table->timestamp('berlaku_mulai')->nullable();
            $table->timestamp('berlaku_sampai')->nullable();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'desa_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kewenangan_desas');
    }
};
