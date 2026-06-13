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
        DB::statement("CREATE VIEW dbo.v_trans_selisih_BPJS_RI_2_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_induk, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, SUM(dbo.tc_trans_jkn.selisih) AS selisih, dbo.tc_trans_jkn.no_kunjungan, 
                      dbo.tc_trans_jkn.kode_kelompok, dbo.tc_trans_jkn.kode_perusahaan, dbo.tc_trans_jkn.tgl_ver, dbo.tc_trans_jkn.status_ver, 
                      dbo.tc_trans_kasir.tgl_ver AS tgl_ver_kasir, dbo.tc_trans_kasir.kode_bagian
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_jkn ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_jkn.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_jkn.no_kunjungan, dbo.tc_trans_jkn.kode_kelompok, dbo.tc_trans_jkn.kode_perusahaan, 
                      dbo.tc_trans_jkn.tgl_ver, dbo.tc_trans_jkn.status_ver, dbo.tc_trans_kasir.tgl_ver, dbo.tc_trans_kasir.kode_bagian
HAVING      (dbo.tc_trans_kasir.tgl_ver IS NOT NULL) AND (dbo.tc_trans_jkn.status_ver = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_trans_selisih_BPJS_RI_2_v]");
    }
};
