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
        DB::statement("CREATE VIEW dbo.upd_dokter
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.mt_master_tarif_detail.bill_rs_pt, dbo.mt_master_tarif_detail.bill_dr1_pt, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.mt_master_tarif_detail.bill_rs_ass, 
                      dbo.mt_master_tarif_detail.bill_dr1_ass, dbo.mt_master_tarif_detail.bill_rs_bpjs, dbo.mt_master_tarif_detail.bill_dr1_bpjs
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.kode_kelompok = 3) AND (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'PEM.DR.SPESIALIS%') AND 
                      (dbo.mt_master_tarif_detail.bill_dr1_pt > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_dokter]");
    }
};
