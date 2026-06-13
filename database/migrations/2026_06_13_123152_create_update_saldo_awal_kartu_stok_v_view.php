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
        DB::statement("CREATE VIEW dbo.update_saldo_awal_kartu_stok_v
AS
SELECT     dbo.mt_rekap_stok_temp.kode_bagian, dbo.mt_rekap_stok_temp.kode_brg, dbo.mt_rekap_stok_temp.saldo_awal, dbo.tc_kartu_stok_awal.kode_bagian AS Expr1, dbo.tc_kartu_stok_awal.stok_awal, 
                      dbo.mt_rekap_stok_temp.id
FROM         dbo.mt_rekap_stok_temp INNER JOIN
                      dbo.tc_kartu_stok_awal ON dbo.mt_rekap_stok_temp.kode_brg = dbo.tc_kartu_stok_awal.kode_brg AND dbo.mt_rekap_stok_temp.kode_bagian = dbo.tc_kartu_stok_awal.kode_bagian AND 
                      dbo.mt_rekap_stok_temp.bln = dbo.tc_kartu_stok_awal.bln AND dbo.mt_rekap_stok_temp.thn = dbo.tc_kartu_stok_awal.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_saldo_awal_kartu_stok_v]");
    }
};
