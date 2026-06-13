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
        DB::statement("CREATE VIEW dbo.bill_blm_selesai_apt_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.bill_rs) AS RS, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr1) AS DR1, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr2) AS DR2, dbo.mt_bagian.nama_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_profit, 
                      dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.nama_pasien, dbo.fr_tc_far.telpon_pasien, dbo.tc_trans_pelayanan.kode_perusahaan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.fr_tc_far ON dbo.tc_trans_pelayanan.kode_trans_far = dbo.fr_tc_far.kode_trans_far
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL) AND (dbo.tc_trans_pelayanan.status_selesai = 2) AND (dbo.tc_trans_pelayanan.status_batal IS NULL)
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.mt_bagian.nama_bagian, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_profit, dbo.fr_tc_far.tgl_trans, 
                      dbo.fr_tc_far.nama_pasien, dbo.fr_tc_far.telpon_pasien, dbo.tc_trans_pelayanan.kode_perusahaan
HAVING      (dbo.tc_trans_pelayanan.no_registrasi = 0) AND (dbo.tc_trans_pelayanan.kode_bagian LIKE '06%') AND (SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.bill_rs) > 0)
ORDER BY dbo.fr_tc_far.tgl_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_blm_selesai_apt_v]");
    }
};
