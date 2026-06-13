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
        DB::statement("CREATE VIEW dbo.upd_kode_perusahaan_trans
AS
SELECT     dbo.tc_registrasi.kode_perusahaan AS kode_perusahaan_reg, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_kasir.pembayar, 
                      dbo.tc_trans_kasir.kd_inv_persh_tx
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_kasir.kode_perusahaan = 207)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kode_perusahaan_trans]");
    }
};
