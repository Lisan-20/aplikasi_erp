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
        DB::statement("CREATE OR ALTER VIEW dbo.penerimaan_barang_union_v
AS
SELECT     no_po, kodesupplier, status_invoice, flag_hutang, kode_penerimaan
FROM         dbo.tc_penerimaan_barang
UNION
SELECT     no_po, kodesupplier, status_invoice, flag_hutang, kode_penerimaan
FROM         dbo.tc_penerimaan_barang_nm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_barang_union_v]");
    }
};
