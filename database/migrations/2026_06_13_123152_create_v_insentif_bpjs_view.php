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
        DB::statement("CREATE OR ALTER VIEW dbo.v_insentif_bpjs
AS
SELECT     dbo.tc_trans_jkn.kode_tc_trans_kasir, dbo.tc_trans_jkn.no_kunjungan, dbo.tc_trans_jkn.no_registrasi, dbo.tc_trans_jkn.no_mr, dbo.tc_trans_jkn.tgl_transaksi, 
                      SUM(dbo.tc_trans_jkn.billing) AS billing, SUM(dbo.tc_trans_jkn.plafon) AS plafon, SUM(dbo.tc_trans_jkn.selisih) AS selisih, dbo.tc_trans_jkn.kode_plafon, 
                      dbo.tc_trans_jkn.kode_bagian_asal, dbo.tc_trans_jkn.flag_ins, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_registrasi.byr_selisih
FROM         dbo.tc_trans_jkn INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_jkn.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_jkn.no_registrasi = dbo.tc_registrasi.no_registrasi
GROUP BY dbo.tc_trans_jkn.kode_tc_trans_kasir, dbo.tc_trans_jkn.no_kunjungan, dbo.tc_trans_jkn.no_registrasi, dbo.tc_trans_jkn.no_mr, dbo.tc_trans_jkn.tgl_transaksi, 
                      dbo.tc_trans_jkn.kode_plafon, dbo.tc_trans_jkn.kode_bagian_asal, dbo.tc_trans_jkn.flag_ins, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, 
                      dbo.tc_registrasi.byr_selisih
HAVING      (dbo.tc_registrasi.byr_selisih IS NULL) OR
                      (dbo.tc_registrasi.byr_selisih = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_insentif_bpjs]");
    }
};
