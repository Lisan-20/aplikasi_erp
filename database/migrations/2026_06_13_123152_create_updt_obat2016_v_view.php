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
        DB::statement("CREATE VIEW dbo.updt_obat2016_v
AS
SELECT     TOP (100) PERCENT dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.obat_oke.[Master Baru], dbo.obat_oke.Status, dbo.mt_barang.status_aktif
FROM         dbo.mt_barang INNER JOIN
                      dbo.obat_oke ON dbo.mt_barang.nama_brg = dbo.obat_oke.[Master Barang lama]
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [updt_obat2016_v]");
    }
};
