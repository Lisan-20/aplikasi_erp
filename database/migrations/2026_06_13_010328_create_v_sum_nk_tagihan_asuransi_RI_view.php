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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sum_nk_tagihan_asuransi_RI
AS
SELECT DISTINCT 
                      dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.no_mr, dbo.mt_bagian.nama_bagian, dbo.mt_master_pasien.no_askes, 
                      dbo.mt_master_pasien.kode_pt, dbo.mt_master_pasien.nik, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.kode_bagian
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.mt_perusahaan ON dbo.tc_trans_kasir.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_kasir.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_kasir.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.nk_perusahaan > 0) AND (dbo.tc_trans_kasir.seri_kuitansi = 'AI')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sum_nk_tagihan_asuransi_RI]");
    }
};
