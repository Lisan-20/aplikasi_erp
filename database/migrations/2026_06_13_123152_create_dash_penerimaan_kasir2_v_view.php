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
        DB::statement("CREATE OR ALTER VIEW dbo.dash_penerimaan_kasir2_v
AS
SELECT     dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.kredit, 
                      dbo.tc_trans_kasir.nk_perusahaan + dbo.tc_trans_kasir.nk AS nota_kredit, dbo.tc_trans_kasir.status_batal, dbo.lap_kinerja_rs_unit_v.kode_kelompok, dbo.tc_trans_kasir.kode_tc_trans_kasir, 
                      dbo.tc_trans_kasir.kode_perusahaan
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.lap_kinerja_rs_unit_v ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.lap_kinerja_rs_unit_v.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.kredit, 
                      dbo.tc_trans_kasir.nk_perusahaan + dbo.tc_trans_kasir.nk, dbo.tc_trans_kasir.status_batal, dbo.lap_kinerja_rs_unit_v.kode_kelompok, dbo.tc_trans_kasir.kode_tc_trans_kasir, 
                      dbo.tc_trans_kasir.kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_penerimaan_kasir2_v]");
    }
};
