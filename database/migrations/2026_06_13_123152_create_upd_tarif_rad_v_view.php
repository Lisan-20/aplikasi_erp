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
        DB::statement("CREATE VIEW dbo.upd_tarif_rad_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif_detail.bill_rs AS tarif_rs, dbo.mt_master_tarif_detail.bill_dr1 AS tarif_dokter, dbo.mt_master_tarif_detail.kode_klas, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.status_selesai
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif_detail.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif AND 
                      dbo.mt_master_tarif_detail.kode_klas = dbo.tc_trans_pelayanan.kode_klas
WHERE     (dbo.tc_trans_pelayanan.no_mr = '186288') AND (dbo.tc_trans_pelayanan.status_selesai < 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tarif_rad_v]");
    }
};
