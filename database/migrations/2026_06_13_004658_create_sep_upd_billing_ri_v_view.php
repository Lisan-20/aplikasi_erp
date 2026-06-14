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
        DB::statement("CREATE OR ALTER VIEW dbo.sep_upd_billing_ri_v
AS
SELECT     dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_registrasi.tgl_jam_keluar, 
                      dbo.tc_registrasi.noSep, YEAR(dbo.tc_registrasi.tgl_jam_keluar) AS thn, MONTH(dbo.tc_registrasi.tgl_jam_keluar) AS bln, DAY(dbo.tc_registrasi.tgl_jam_keluar) 
                      AS tgl
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_registrasi.noSep IS NULL) AND (dbo.tc_trans_kasir.seri_kuitansi = 'AI')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sep_upd_billing_ri_v]");
    }
};
