<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR ALTER VIEW dbo.mt_operasi_v
AS
SELECT     nama_tarif, tingkatan, kode_bagian, kode_tarif, referensi
FROM         dbo.mt_master_tarif
GROUP BY nama_tarif, tingkatan, kode_bagian, kode_tarif, referensi
HAVING      (tingkatan = 3) AND (kode_bagian = '030901')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_operasi_v]");
    }
};
