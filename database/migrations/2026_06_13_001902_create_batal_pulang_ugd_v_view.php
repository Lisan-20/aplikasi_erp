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
        DB::statement("CREATE OR ALTER VIEW dbo.batal_pulang_ugd_v
AS
SELECT     dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_keluar, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.gd_tc_gawat_darurat ON dbo.tc_kunjungan.no_kunjungan = dbo.gd_tc_gawat_darurat.no_kunjungan LEFT OUTER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL) OR
                      (dbo.tc_trans_pelayanan.kode_tc_trans_kasir = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [batal_pulang_ugd_v]");
    }
};
