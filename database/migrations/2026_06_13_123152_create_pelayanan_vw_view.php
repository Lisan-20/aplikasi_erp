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
        DB::statement("CREATE OR ALTER VIEW dbo.pelayanan_vw
AS
SELECT     TOP (100) PERCENT no_kunjungan, kode_bagian, status_selesai, jenis_tindakan
FROM         dbo.tc_trans_pelayanan
GROUP BY no_kunjungan, kode_bagian, status_selesai, jenis_tindakan
HAVING      (kode_bagian = '020101') AND (jenis_tindakan = 12) AND (status_selesai > 1)
ORDER BY no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pelayanan_vw]");
    }
};
