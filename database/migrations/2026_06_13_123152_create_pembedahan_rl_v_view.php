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
        DB::statement("CREATE VIEW dbo.pembedahan_rl_v
AS
SELECT     dbo.tc_trans_pelayanan_v.kode_tarif, dbo.bedah_level_4_v.nama_tarif, COUNT(dbo.bedah_level_4_v.nama_tarif) AS jml, dbo.bedah_level_4_v.level_3, dbo.bedah_level_4_v.kode, 
                      dbo.tc_trans_pelayanan_v.bln, dbo.tc_trans_pelayanan_v.thn, dbo.tc_trans_pelayanan_v.tgl_transaksi
FROM         dbo.tc_trans_pelayanan_v INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan_v.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.bedah_level_4_v ON dbo.mt_master_tarif.referensi = dbo.bedah_level_4_v.kode_tarif
GROUP BY dbo.tc_trans_pelayanan_v.kode_tarif, dbo.bedah_level_4_v.level_3, dbo.bedah_level_4_v.nama_tarif, dbo.bedah_level_4_v.kode, dbo.tc_trans_pelayanan_v.bln, dbo.tc_trans_pelayanan_v.thn, 
                      dbo.tc_trans_pelayanan_v.tgl_transaksi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pembedahan_rl_v]");
    }
};
