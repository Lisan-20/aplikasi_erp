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
        DB::statement("CREATE VIEW dbo.pasien_ok_vk_v
AS
SELECT DISTINCT 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.pembayar, 
                      dbo.mt_master_pasien.nama_kel_pasien, dbo.mt_master_tarif.nama_tarif, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bulan_plg, YEAR(dbo.tc_trans_kasir.tgl_jam) 
                      AS tahun_plg
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_kasir.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.kode_bagian LIKE '03%') AND (dbo.tc_trans_pelayanan.kode_tarif IN
                          (SELECT DISTINCT kode_tarif
                            FROM          dbo.mt_master_tarif_detail_bedah)) AND (YEAR(dbo.tc_trans_kasir.tgl_jam) >= 2014)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_ok_vk_v]");
    }
};
