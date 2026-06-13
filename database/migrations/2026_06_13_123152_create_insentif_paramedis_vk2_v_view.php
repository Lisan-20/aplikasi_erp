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
        DB::statement("CREATE VIEW dbo.insentif_paramedis_vk2_v
AS
SELECT     dbo.insentif_paramedis_vk_v.no_registrasi AS jml_pasien, dbo.insentif_paramedis_vk_v.bill_dr1, dbo.insentif_paramedis_vk_v.bill_rs, dbo.insentif_paramedis_vk_v.kode_tarif, 
                      dbo.insentif_paramedis_vk_v.kode_paramedis, dbo.insentif_paramedis_vk_v.kode_dokter1, dbo.insentif_paramedis_vk_v.tgl_transaksi, dbo.insentif_paramedis_vk_v.status_batal, 
                      dbo.insentif_paramedis_vk_v.kode_tc_trans_kasir, dbo.insentif_paramedis_vk_v.no_mr, dbo.insentif_paramedis_vk_v.nama_pasien_layan, dbo.insentif_paramedis_vk_v.nama_tindakan, 
                      dbo.mt_master_tarif.nominal_insentif, dbo.insentif_paramedis_vk_v.bill_dr1 + dbo.insentif_paramedis_vk_v.bill_rs AS total
FROM         dbo.insentif_paramedis_vk_v INNER JOIN
                      dbo.mt_master_tarif ON dbo.insentif_paramedis_vk_v.kode_tarif = dbo.mt_master_tarif.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [insentif_paramedis_vk2_v]");
    }
};
