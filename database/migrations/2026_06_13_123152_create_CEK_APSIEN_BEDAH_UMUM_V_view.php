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
        DB::statement("CREATE VIEW dbo.CEK_APSIEN_BEDAH_UMUM_V
AS
SELECT DISTINCT dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.mt_master_pasien.nama_pasien
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.tc_trans_pelayanan.kode_bagian IN ('030901')) AND (dbo.tc_registrasi.kode_kelompok = 3) AND (dbo.tc_trans_pelayanan.no_registrasi NOT IN
                          (SELECT DISTINCT no_registrasi
                            FROM          dbo.tc_trans_pelayanan AS tc_trans_pelayanan_1
                            WHERE      (kode_bagian = '031001'))) AND (dbo.tc_registrasi.kode_bagian_keluar LIKE '03%') AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [CEK_APSIEN_BEDAH_UMUM_V]");
    }
};
