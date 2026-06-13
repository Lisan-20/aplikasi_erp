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
        DB::statement("CREATE VIEW dbo.lap_bedah_bulanan_v
AS
SELECT     dbo.mt_master_tarif.referensi, dbo.bedah_level_4_v.level_3, dbo.bedah_level_4_v.nama_tarif, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, 
                      YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, dbo.tc_trans_pelayanan.status_batal, COUNT(dbo.bedah_level_4_v.level_3) AS tarif, 
                      dbo.bedah_level_4_v.kode
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.bedah_level_4_v ON dbo.mt_master_tarif.referensi = dbo.bedah_level_4_v.kode_tarif
GROUP BY dbo.mt_master_tarif.referensi, dbo.bedah_level_4_v.level_3, dbo.bedah_level_4_v.nama_tarif, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), 
                      YEAR(dbo.tc_trans_pelayanan.tgl_transaksi), dbo.tc_trans_pelayanan.status_batal, dbo.bedah_level_4_v.kode
HAVING      (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_bedah_bulanan_v]");
    }
};
