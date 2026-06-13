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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_kode_bagian_asal_v
AS
SELECT     dbo.tran_kasir.no_registrasi, dbo.tran_kasir.kode_bagian, dbo.tran_sed.kode_bagian AS kode_bagian_trans, dbo.tran_sed.kode_bagian_asal, 
                      dbo.tran_kasir.seri_kuitansi, dbo.tran_kasir.no_kuitansi, dbo.tran_kasir.kode_tc_trans_kasir
FROM         dbo.tran_kasir INNER JOIN
                      dbo.tran_sed ON dbo.tran_kasir.kode_tc_trans_kasir = dbo.tran_sed.kode_tc_trans_kasir AND dbo.tran_kasir.kode_bagian <> dbo.tran_sed.kode_bagian INNER JOIN
                      dbo.jml_kobag_tran_v ON dbo.tran_kasir.kode_tc_trans_kasir = dbo.jml_kobag_tran_v.kode_tc_trans_kasir
WHERE     (dbo.tran_kasir.flag_jurnal IS NULL) AND (dbo.tran_sed.flag_jurnal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kode_bagian_asal_v]");
    }
};
