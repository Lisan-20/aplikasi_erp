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
        DB::statement("CREATE VIEW dbo.v_trans_UM_pulang
AS
SELECT     dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.ks_tc_trans_um.kode_bagian, dbo.ks_tc_trans_um.jumlah AS uang_muka, dbo.tc_trans_kasir.flag_jurnal, dbo.tc_trans_kasir.tgl_ver, 
                      dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.cek_kasir_jurnal.tgl_jam, dbo.tc_trans_kasir.kode_inap
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.ks_tc_trans_um ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.ks_tc_trans_um.kode_tc_trans_kasir INNER JOIN
                      dbo.cek_kasir_jurnal ON dbo.tc_trans_kasir.no_registrasi = dbo.cek_kasir_jurnal.no_registrasi
WHERE     (dbo.tc_trans_kasir.seri_kuitansi = 'UM') AND (dbo.ks_tc_trans_um.kode_tc_trans_kasir_bayar IS NOT NULL) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND 
                      (dbo.tc_trans_kasir.flag_jurnal = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_trans_UM_pulang]");
    }
};
