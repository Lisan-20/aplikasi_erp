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
        DB::statement("CREATE OR ALTER VIEW dbo.v_hasil_verifikasi_tagihan
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_kasir_unuion_v.seri_kuitansi, dbo.tc_trans_kasir_unuion_v.no_kuitansi, dbo.tc_trans_kasir_unuion_v.tgl_jam, 
                      dbo.tc_trans_kasir_unuion_v.no_mr, dbo.tc_trans_kasir_unuion_v.kd_inv_persh_tx, dbo.tc_trans_kasir_unuion_v.flag_tagih, 
                      dbo.tc_trans_kasir_unuion_v.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan, dbo.mt_master_pasien.nama_pasien, 
                      dbo.tc_trans_kasir_unuion_v.status_batal, dbo.tc_trans_kasir_unuion_v.nk_perusahaan, dbo.tc_tagih.no_invoice_tagih, 
                      dbo.tc_trans_kasir_unuion_v.kode_tc_trans_kasir, dbo.tc_trans_kasir_unuion_v.no_registrasi
FROM         dbo.mt_master_pasien RIGHT OUTER JOIN
                      dbo.tc_tagih RIGHT OUTER JOIN
                      dbo.tc_trans_kasir_unuion_v LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.tc_trans_kasir_unuion_v.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan ON 
                      dbo.tc_tagih.id_tc_tagih = dbo.tc_trans_kasir_unuion_v.kd_inv_persh_tx ON 
                      dbo.mt_master_pasien.no_mr = dbo.tc_trans_kasir_unuion_v.no_mr
WHERE     (dbo.tc_trans_kasir_unuion_v.flag_tagih = 1) AND (dbo.tc_trans_kasir_unuion_v.status_batal IS NULL)
ORDER BY dbo.tc_trans_kasir_unuion_v.kode_tc_trans_kasir DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_hasil_verifikasi_tagihan]");
    }
};
