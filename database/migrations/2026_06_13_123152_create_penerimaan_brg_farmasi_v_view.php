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
        DB::statement("CREATE VIEW dbo.penerimaan_brg_farmasi_v
AS
SELECT     TOP (100) PERCENT MONTH(a.tgl_po) AS bln, YEAR(a.tgl_po) AS thn, c.nama_brg, SUM(b.jumlah_besar) AS jumlah_besar, SUM(d.jumlah_kirim) AS jumlah_kirim, c.kode_brg, c.[content], 
                      SUM(d.jumlah_kirim * b.[content]) AS masuk_gdg, a.flag_is
FROM         dbo.tc_po AS a INNER JOIN
                      dbo.tc_po_det AS b ON a.id_tc_po = b.id_tc_po INNER JOIN
                      dbo.mt_barang AS c ON b.kode_brg = c.kode_brg INNER JOIN
                      dbo.tc_penerimaan_barang_detail AS d ON b.id_tc_po_det = d.id_tc_po_det
GROUP BY MONTH(a.tgl_po), YEAR(a.tgl_po), c.nama_brg, c.kode_brg, c.[content], a.flag_is
HAVING      (SUM(d.jumlah_kirim) > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_brg_farmasi_v]");
    }
};
