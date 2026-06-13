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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_barang_obat_khusus_v
AS
SELECT     medi2cbr_bak.dbo.mt_barang.obat_khusus, mt_barang_1.obat_khusus AS upd, mt_barang_1.kode_brg
FROM         medi2cbr_bak.dbo.mt_barang INNER JOIN
                      dbo.mt_barang AS mt_barang_1 ON medi2cbr_bak.dbo.mt_barang.kode_brg = mt_barang_1.kode_brg
WHERE     (mt_barang_1.obat_khusus = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_barang_obat_khusus_v]");
    }
};
