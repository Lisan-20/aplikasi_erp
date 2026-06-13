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
        DB::statement("CREATE VIEW dbo.upd_bagian_tran_kasir_v
AS
SELECT     dbo.tran_kasir.kode_tc_trans_kasir, dbo.tran_kasir.no_registrasi, dbo.tran_kasir.seri_kuitansi, dbo.tran_kasir.no_kuitansi, dbo.tran_kasir.tgl_jam, 
                      dbo.tran_kasir.kode_bagian, dbo.tc_trans_kasir.kode_bagian AS kode_bagian_trans
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tran_kasir ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tran_kasir.kode_tc_trans_kasir AND 
                      dbo.tc_trans_kasir.kode_bagian <> dbo.tran_kasir.kode_bagian AND dbo.tran_kasir.flag_jurnal IS NULL
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_bagian_tran_kasir_v]");
    }
};
