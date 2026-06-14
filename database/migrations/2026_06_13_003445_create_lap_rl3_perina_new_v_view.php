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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rl3_perina_new_v
AS
SELECT     dbo.mt_icd_diagnosa.nama_diagnosa, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, dbo.th_riwayat_pasien.no_mr AS jumlah
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.th_riwayat_pasien ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.th_riwayat_pasien.no_kunjungan INNER JOIN
                      dbo.mt_icd_diagnosa ON dbo.th_riwayat_pasien.kode_icd_diagnosa = dbo.mt_icd_diagnosa.kode_icd_diagnosa INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.th_riwayat_pasien.kode_bagian = '030601')
GROUP BY dbo.mt_icd_diagnosa.nama_diagnosa, YEAR(dbo.tc_trans_kasir.tgl_jam), MONTH(dbo.tc_trans_kasir.tgl_jam), dbo.th_riwayat_pasien.no_mr
HAVING      (dbo.mt_icd_diagnosa.nama_diagnosa <> '')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rl3_perina_new_v]");
    }
};
