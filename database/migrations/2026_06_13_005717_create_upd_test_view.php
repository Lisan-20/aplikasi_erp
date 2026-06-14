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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_test
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.tambahan, dbo.tc_trans_kasir.potongan, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.nk, 
                      dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nk_askes, dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_kasir.nama_pasien, 
                      dbo.tc_trans_kasir.pembayar, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.kode_bagian, SUM(dbo.tc_trans_jkn.billing) AS billing, 
                      SUM(dbo.tc_trans_jkn.plafon) AS plafon, SUM(dbo.tc_trans_jkn.selisih) AS selisih, SUM(dbo.tc_trans_jkn.tagihan) AS tagihan, dbo.tc_trans_kasir.nk_bpjs
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_jkn ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_jkn.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_kasir.nk_bpjs IS NULL) AND (dbo.tc_trans_kasir.status_batal IS NULL)
GROUP BY dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.tambahan, dbo.tc_trans_kasir.potongan, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.nk, 
                      dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nk_askes, dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_kasir.nama_pasien, 
                      dbo.tc_trans_kasir.pembayar, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.nk_bpjs
HAVING      (dbo.tc_trans_kasir.kode_perusahaan = 219)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_test]");
    }
};
