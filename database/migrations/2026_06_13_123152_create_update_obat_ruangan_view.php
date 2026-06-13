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
        DB::statement("CREATE OR ALTER VIEW dbo.update_obat_ruangan
AS
SELECT     dbo.tc_obat_ruangan.kode_brg, dbo.mt_rekap_stok.harga_beli, dbo.tc_obat_ruangan.harga_beli AS Expr1, dbo.tc_obat_ruangan.status, 
                      dbo.tc_obat_ruangan.harga_jual, dbo.tc_obat_ruangan.jumlah, dbo.tc_obat_ruangan.harga_jual * dbo.tc_obat_ruangan.jumlah AS harga, 
                      dbo.tc_obat_ruangan.harga_beli * dbo.tc_obat_ruangan.jumlah AS beli
FROM         dbo.tc_obat_ruangan INNER JOIN
                      dbo.mt_rekap_stok ON dbo.tc_obat_ruangan.kode_brg = dbo.mt_rekap_stok.kode_brg AND 
                      dbo.tc_obat_ruangan.harga_beli = dbo.mt_rekap_stok.harga_beli
WHERE     (dbo.tc_obat_ruangan.status = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_obat_ruangan]");
    }
};
