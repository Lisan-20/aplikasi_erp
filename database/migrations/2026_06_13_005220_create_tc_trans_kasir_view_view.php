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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_trans_kasir_view
AS
SELECT     seri_kuitansi, no_kuitansi, tgl_jam, no_mr, no_registrasi, tunai, debet, kredit, nd, nk, nk_karyawan, nk_perusahaan, status_batal, DAY(tgl_jam) AS tgl, MONTH(tgl_jam) 
                      AS bln, YEAR(tgl_jam) AS thn
FROM         dbo.tc_trans_kasir
WHERE     (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_kasir_view]");
    }
};
