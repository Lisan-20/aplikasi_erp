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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_ri_perawat_temp_v
AS
SELECT     kode_pemeriksaan, nama_pemeriksaan, no_registrasi, DAY(tgl_update) AS tgl, MONTH(tgl_update) AS bln, YEAR(tgl_update) AS thn
FROM         dbo.tc_pemeriksaan_ri_perawat_temp
WHERE     (kd_ref IN ('10501')) AND (hasil = 1) AND (kode_rm IN (126, 150))
GROUP BY kode_pemeriksaan, nama_pemeriksaan, no_registrasi, DAY(tgl_update), MONTH(tgl_update), YEAR(tgl_update)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_ri_perawat_temp_v]");
    }
};
