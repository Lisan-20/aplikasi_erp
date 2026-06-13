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
        DB::statement("CREATE VIEW dbo.updt_mt_supplier_v
AS
SELECT        dbo.tc_referensi.kodesupplier, dbo.mt_barang.kode_supplier, dbo.mt_barang.kode_brg
FROM            dbo.mt_barang INNER JOIN
                         dbo.tc_referensi_det ON dbo.mt_barang.kode_brg = dbo.tc_referensi_det.kode_brg INNER JOIN
                         dbo.tc_referensi ON dbo.tc_referensi_det.id_tc_ref = dbo.tc_referensi.id_tc_ref
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [updt_mt_supplier_v]");
    }
};
