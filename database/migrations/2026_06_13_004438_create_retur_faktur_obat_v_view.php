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
        DB::statement("CREATE OR ALTER VIEW dbo.retur_faktur_obat_v
AS
SELECT        dbo.tc_retur_supplier.no_lpb, dbo.tc_penerimaan_barang.flag_hutang, dbo.tc_penerimaan_barang.status_invoice, dbo.tc_penerimaan_barang.no_faktur, 
                         dbo.tc_retur_supplier.kode_detail_penerimaan_barang, dbo.tc_retur_supplier.jumlah
FROM            dbo.tc_retur_supplier INNER JOIN
                         dbo.tc_penerimaan_barang ON dbo.tc_retur_supplier.no_lpb = dbo.tc_penerimaan_barang.kode_penerimaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [retur_faktur_obat_v]");
    }
};
