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
        Schema::create('pelaporans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan', 30)->unique();
            $table->foreignId('desa_id')->constrained('master_desas')->cascadeOnDelete();
            $table->foreignId('pelapor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_anonim')->default(false);
            $table->string('nama_pelapor_terenkripsi')->nullable();
            $table->string('no_wa_terenkripsi')->nullable();
            $table->string('judul_laporan');
            $table->text('isi_laporan');
            $table->string('bukti_url')->nullable();
            $table->enum('kategori', ['PENYIMPANGAN_ANGGARAN', 'MARK_UP', 'FIKTIF', 'PENYALAHGUNAAN', 'LAINNYA'])->default('LAINNYA');
            $table->enum('status', ['BARU', 'DIPROSES', 'SELESAI', 'DITOLAK'])->default('BARU');
            $table->text('tindak_lanjut')->nullable();
            $table->enum('kanal', ['WHATSAPP', 'WEB', 'LANGSUNG'])->default('WEB');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporans');
    }
};
