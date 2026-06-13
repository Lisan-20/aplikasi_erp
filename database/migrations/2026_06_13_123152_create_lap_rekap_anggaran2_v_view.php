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
        DB::statement("CREATE VIEW dbo.lap_rekap_anggaran2_v
AS
SELECT     dbo.lap_rekap_anggaran_far_v.nama_brg, dbo.tc_stok_opname.kode_brg, SUM(dbo.lap_rekap_anggaran_far_v.real) AS jml_pakai, 
                      MONTH(dbo.tc_stok_opname.tgl_stok_opname) AS bln_SO, dbo.tc_stok_opname.stok_sekarang AS SO, dbo.tc_stok_opname.stok_sebelum AS stok_awal
FROM         dbo.lap_rekap_anggaran_far_v INNER JOIN
                      dbo.tc_stok_opname ON dbo.lap_rekap_anggaran_far_v.kode_brg = dbo.tc_stok_opname.kode_brg
WHERE     (dbo.tc_stok_opname.kode_bagian = '060101') AND (dbo.lap_rekap_anggaran_far_v.bln = MONTH(dbo.tc_stok_opname.tgl_stok_opname))
GROUP BY dbo.lap_rekap_anggaran_far_v.nama_brg, dbo.tc_stok_opname.kode_brg, MONTH(dbo.tc_stok_opname.tgl_stok_opname), dbo.tc_stok_opname.stok_sekarang, 
                      dbo.tc_stok_opname.stok_sebelum
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_anggaran2_v]");
    }
};
