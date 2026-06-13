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
        DB::statement("CREATE OR ALTER VIEW dbo.v_dr_spesialis_bpjs
AS
SELECT DISTINCT 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.kode_dokter1, dbo.mt_karyawan.kode_spesialisasi, 
                      dbo.tc_trans_pelayanan.kode_kelompok
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.kode_dokter
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.kode_dokter1, dbo.mt_karyawan.kode_spesialisasi, 
                      dbo.tc_trans_pelayanan.kode_kelompok
HAVING      (NOT (dbo.mt_karyawan.kode_spesialisasi IN (1, 12, 11))) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_dr_spesialis_bpjs]");
    }
};
