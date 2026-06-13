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
        DB::statement("CREATE VIEW dbo.upd_kode_bagian_v
AS
SELECT     dbo.tran_kasir.kode_bagian AS kode_bagian_kasir, dbo.tran_sed.kode_bagian, dbo.tran_kasir.kode_tc_trans_kasir
FROM         dbo.tran_kasir INNER JOIN
                      dbo.tran_sed ON dbo.tran_kasir.kode_tc_trans_kasir = dbo.tran_sed.kode_tc_trans_kasir
WHERE     (dbo.tran_kasir.seri_kuitansi IN ('AI', 'RI')) AND (dbo.tran_sed.kode_bagian NOT LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kode_bagian_v]");
    }
};
