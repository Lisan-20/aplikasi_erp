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
        DB::statement("CREATE VIEW dbo.upd_tgl
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.mt_master_pasien.nama_pasien, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_kasir.nama_pasien AS Expr1, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_pelayanan.kode_bagian_asal
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (DAY(dbo.tc_trans_pelayanan.tgl_transaksi) = 29) AND (dbo.tc_trans_pelayanan.kode_kelompok = 5) AND (dbo.tc_trans_pelayanan.kode_perusahaan = 85) AND 
                      (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) = 3) AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_bagian_asal = '011801')
ORDER BY dbo.tc_trans_pelayanan.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tgl]");
    }
};
