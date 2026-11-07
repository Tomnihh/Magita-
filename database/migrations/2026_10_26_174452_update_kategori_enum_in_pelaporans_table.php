<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE pelaporans MODIFY COLUMN kategori ENUM('GRATIFIKASI','KORUPSI','PENYALAHGUNAAN','MARK_UP') NOT NULL DEFAULT 'KORUPSI'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pelaporans MODIFY COLUMN kategori ENUM('PENYIMPANGAN_ANGGARAN','MARK_UP','FIKTIF','PENYALAHGUNAAN','LAINNYA') NOT NULL DEFAULT 'LAINNYA'");
    }
};
