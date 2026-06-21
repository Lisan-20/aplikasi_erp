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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sum_tagihan_jkn_v
AS
SELECT     dbo.tc_trans_jkn.no_registrasi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.nk_perusahaan, SUM(dbo.tc_trans_jkn.billing) AS billing, SUM(dbo.tc_trans_jkn.selisih) 
                      AS selisih, SUM(dbo.tc_trans_jkn.tagihan) AS tagihan, SUM(dbo.tc_trans_jkn.plafon) AS plafon, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.status_batal, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.kode_bagian, 
                      dbo.tc_trans_jkn.no_kunjungan, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.flag_tagih, dbo.tc_trans_kasir.nk_bpjs
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.tc_trans_jkn ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_jkn.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_jkn.no_registrasi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.status_batal, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.kode_bagian, 
                      dbo.tc_trans_jkn.no_kunjungan, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.flag_tagih, dbo.tc_trans_kasir.nk_bpjs
HAVING      (dbo.tc_trans_kasir.nk_bpjs > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sum_tagihan_jkn_v]");
    }
};
