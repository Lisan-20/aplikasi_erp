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
        DB::statement("CREATE VIEW dbo.lap_bedah_v
AS
SELECT     dbo.mt_master_tarif.kode_tarif, COUNT(dbo.tc_trans_pelayanan.no_registrasi) AS no_registrasi, DAY(dbo.tc_trans_pelayanan.tgl_transaksi) AS tgl, 
                      MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.mt_master_tarif.nama_tarif, dbo.bedah_level_4_v.kode, dbo.bedah_level_3_v.nama_tarif AS level_3
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.bedah_level_4_v ON dbo.mt_master_tarif.referensi = dbo.bedah_level_4_v.kode_tarif INNER JOIN
                      dbo.bedah_level_3_v ON dbo.bedah_level_4_v.kode = dbo.bedah_level_3_v.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0)
GROUP BY dbo.mt_master_tarif.kode_tarif, DAY(dbo.tc_trans_pelayanan.tgl_transaksi), MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), 
                      YEAR(dbo.tc_trans_pelayanan.tgl_transaksi), dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_master_tarif.nama_tarif, dbo.bedah_level_4_v.kode, 
                      dbo.bedah_level_3_v.nama_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_bedah_v]");
    }
};
