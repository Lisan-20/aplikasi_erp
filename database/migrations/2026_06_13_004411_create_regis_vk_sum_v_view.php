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
        DB::statement("CREATE OR ALTER VIEW dbo.regis_vk_sum_v
AS
SELECT     TOP (100) PERCENT dbo.tc_registrasi.no_registrasi, 'Observasi VK' AS nama_tarif, 5000 AS nominal_insentif, 101011 AS kode_tarif, 1 AS jml_pasien, dbo.tc_registrasi.status_batal, 
                      dbo.tc_registrasi.no_mr, dbo.tc_registrasi.tgl_jam_keluar, dbo.mt_master_pasien.nama_pasien, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.tgl_jam AS tgl_transaksi, 
                      YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi RIGHT OUTER JOIN
                      dbo.tindakan_vk_v ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tindakan_vk_v.kode_tc_trans_kasir
WHERE     (NOT (dbo.tc_registrasi.no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.insentif_paramedis_vk_v)))
ORDER BY dbo.tc_registrasi.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [regis_vk_sum_v]");
    }
};
