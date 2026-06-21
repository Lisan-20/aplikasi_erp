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
        DB::statement("CREATE OR ALTER VIEW dbo.harga_ref_v
AS
SELECT     TOP (100) PERCENT dbo.tc_referensi_det.tgl_ref AS tgl, dbo.tc_referensi_det.kode_brg, dbo.tc_referensi_det.jumlah_besar, dbo.tc_referensi_det.rasio AS isi, dbo.tc_referensi_det.satuan, 
                      dbo.tc_referensi_det.harga_satuan_netto AS harga, dbo.tc_referensi.kodesupplier, dbo.tc_referensi_det.pilih_satuan, dbo.tc_referensi_det.discount
FROM         dbo.tc_referensi INNER JOIN
                      dbo.tc_referensi_det ON dbo.tc_referensi.id_tc_ref = dbo.tc_referensi_det.id_tc_ref
WHERE     (dbo.tc_referensi_det.harga_satuan_netto > 0)
ORDER BY tgl DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [harga_ref_v]");
    }
};
