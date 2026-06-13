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
        DB::statement("CREATE VIEW dbo.v_po_rev_4
AS
SELECT     TOP (100) PERCENT tgl_po, kode_brg, harga_satuan, satuan, pilih_satuan, kodesupplier
FROM         dbo.v_po_rev_3
ORDER BY tgl_po DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_po_rev_4]");
    }
};
