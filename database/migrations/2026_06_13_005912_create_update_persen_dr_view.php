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
        DB::statement("CREATE OR ALTER VIEW dbo.update_persen_dr
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.persen_dr, dbo.mt_barang_3.persen_dr AS persen_dr_ref
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_barang_3 ON dbo.mt_barang.kode_brg = dbo.mt_barang_3.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_persen_dr]");
    }
};
