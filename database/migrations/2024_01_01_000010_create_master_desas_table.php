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
        Schema::create('master_desas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_desa', 20)->unique()->nullable();
            $table->string('nama_desa');
            $table->string('kecamatan');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->enum('status_risiko', ['HIJAU', 'KUNING', 'MERAH'])->default('HIJAU');
            $table->decimal('pagu_anggaran', 15, 2)->default(0);
            $table->decimal('realisasi_anggaran', 15, 2)->default(0);
            $table->year('tahun_anggaran')->default(date('Y'));
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_desas');
    }
};
