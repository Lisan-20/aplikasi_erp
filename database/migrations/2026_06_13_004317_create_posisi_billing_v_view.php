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
        DB::statement("CREATE OR ALTER VIEW dbo.posisi_billing_v
AS
SELECT     dbo.mt_perusahaan.flag_kapitasi, dbo.mt_perusahaan.flag_jpk, CASE WHEN dbo.tc_trans_kasir.kode_perusahaan IS NULL 
                      THEN 0 ELSE dbo.tc_trans_kasir.kode_perusahaan END AS kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, 
                      dbo.tc_registrasi.no_registrasi, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.nk_perusahaan, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, 
                      dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.flag_tagih, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.pembayar, 
                      dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.tgl_jam
FROM         dbo.tc_trans_kasir LEFT OUTER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.tc_trans_kasir.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.tc_trans_kasir.nk_perusahaan > 0) AND (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [posisi_billing_v]");
    }
};
