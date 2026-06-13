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
        DB::statement("CREATE VIEW dbo.perhitungan_bpjs_vk_RI_baru_v
AS
SELECT     TOP (100) PERCENT dbo.mt_jenis_tindakan.jenis_tindakan, SUM(CAST((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs AS int)) AS rs, 
                      SUM(CAST((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr1 AS int)) AS dr, dbo.mt_jenis_tindakan.kode
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_jenis_tindakan ON dbo.tc_trans_pelayanan.jenis_tindakan = dbo.mt_jenis_tindakan.kode_jenis_tindakan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_registrasi.tgl_jam_keluar IS NOT NULL) AND (dbo.tc_trans_pelayanan.kode_kelompok IN (8, 9, 10, 11, 12)) AND (dbo.tc_registrasi.tgl_jam_keluar BETWEEN CONVERT(DATETIME, 
                      '2017-01-01 00:00:00', 102) AND CONVERT(DATETIME, '2017-03-31 23:59:59', 102)) AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (NOT (dbo.tc_registrasi.no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.pasien_icu_v))) AND (dbo.tc_registrasi.no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.pasien_rinap_v)) AND (NOT (dbo.tc_registrasi.no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.pasien_bedah_v))) AND (dbo.tc_registrasi.no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.pasien_vk_v))
GROUP BY dbo.mt_jenis_tindakan.jenis_tindakan, dbo.mt_jenis_tindakan.kode
ORDER BY dbo.mt_jenis_tindakan.jenis_tindakan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [perhitungan_bpjs_vk_RI_baru_v]");
    }
};
