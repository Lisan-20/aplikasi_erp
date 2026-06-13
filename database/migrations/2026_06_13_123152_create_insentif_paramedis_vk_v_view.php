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
        DB::statement("CREATE VIEW dbo.insentif_paramedis_vk_v
AS
SELECT     COUNT(dbo.tc_trans_pelayanan.no_registrasi) AS jml_pasien, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_registrasi, dbo.mt_master_tarif.nominal_insentif, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_tarif.nama_tarif, 
                      dbo.tc_trans_kasir.tgl_jam AS tgl_transaksi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_registrasi, 
                      dbo.mt_master_tarif.nominal_insentif, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_tarif.nama_tarif, dbo.tc_trans_kasir.tgl_jam
HAVING      (dbo.mt_master_tarif.nominal_insentif > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [insentif_paramedis_vk_v]");
    }
};
