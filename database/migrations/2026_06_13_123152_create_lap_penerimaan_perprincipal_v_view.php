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
        DB::statement("CREATE VIEW dbo.lap_penerimaan_perprincipal_v
AS
SELECT     TOP (100) PERCENT a.kodesupplier, SUM(b.harga_satuan) AS harga_satuan, SUM(b.harga_satuan_netto) AS harga_satuan_netto, SUM(b.jumlah_besar) AS jumlah_besar, b.ppn, 
                      SUM(b.jumlah_harga_netto) AS jumlah_harga_netto, SUM(d.jumlah_kirim) AS jumlah_kirim, dbo.mt_supplier.namasupplier, SUM(d.jumlah_pesan) AS jumlah_pesan, a.tgl_po, 
                      SUM(b.jumlah_harga_netto * b.discount / 100) AS jumlah_diskon, a.flag_is
FROM         dbo.tc_po AS a INNER JOIN
                      dbo.tc_po_det AS b ON a.id_tc_po = b.id_tc_po INNER JOIN
                      dbo.mt_barang AS c ON b.kode_brg = c.kode_brg INNER JOIN
                      dbo.tc_penerimaan_barang_detail AS d ON b.id_tc_po_det = d.id_tc_po_det AND b.jumlah_besar = d.jumlah_kirim INNER JOIN
                      dbo.mt_supplier ON a.kodesupplier = dbo.mt_supplier.kodesupplier
GROUP BY a.kodesupplier, b.ppn, dbo.mt_supplier.namasupplier, a.tgl_po, a.flag_is
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_penerimaan_perprincipal_v]");
    }
};
