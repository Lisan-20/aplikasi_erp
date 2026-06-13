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
        DB::statement("CREATE VIEW dbo.hasil_referensi_harga_v
AS
SELECT     dbo.tc_referensi_det.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_referensi_det.harga_satuan_netto, dbo.tc_referensi_det.rasio, dbo.tc_referensi_det.satuan, dbo.mt_supplier.namasupplier, 
                      dbo.mt_barang.flag_medis
FROM         dbo.tc_referensi_det INNER JOIN
                      dbo.tc_referensi ON dbo.tc_referensi_det.id_tc_ref = dbo.tc_referensi.id_tc_ref INNER JOIN
                      dbo.mt_barang ON dbo.tc_referensi_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_supplier ON dbo.tc_referensi.kodesupplier = dbo.mt_supplier.kodesupplier
GROUP BY dbo.tc_referensi_det.kode_brg, dbo.tc_referensi_det.harga_satuan_netto, dbo.mt_barang.nama_brg, dbo.tc_referensi_det.rasio, dbo.tc_referensi_det.satuan, dbo.mt_supplier.namasupplier, 
                      dbo.mt_barang.flag_medis
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hasil_referensi_harga_v]");
    }
};
