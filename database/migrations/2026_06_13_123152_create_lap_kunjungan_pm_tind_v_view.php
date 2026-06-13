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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_pm_tind_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.referensi, dbo.tc_trans_pelayanan.kode_tarif, dbo.mt_master_tarif.nama_tarif, SUM(dbo.tc_trans_pelayanan.jumlah) AS JmlTind, 
                      DAY(dbo.tc_trans_pelayanan.tgl_transaksi) AS tgl, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, 
                      dbo.mt_master_tarif.kode_bagian
FROM         dbo.pm_pasien_pm_all_v INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_pasien_pm_all_v.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.mt_master_tarif.jenis_tindakan = 3) AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.status_selesai > 1)
GROUP BY dbo.mt_master_tarif.referensi, dbo.tc_trans_pelayanan.kode_tarif, dbo.mt_master_tarif.nama_tarif, DAY(dbo.tc_trans_pelayanan.tgl_transaksi), MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), 
                      YEAR(dbo.tc_trans_pelayanan.tgl_transaksi), dbo.mt_master_tarif.kode_bagian
HAVING      (NOT (dbo.mt_master_tarif.nama_tarif LIKE 'Administrasi'))
ORDER BY tgl, bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_tind_v]");
    }
};
