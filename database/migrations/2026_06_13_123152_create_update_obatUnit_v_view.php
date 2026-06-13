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
        DB::statement("CREATE OR ALTER VIEW dbo.update_obatUnit_v
AS
SELECT     dbo.mutasi_unit_link_v.kode_bagian_kirim, dbo.mutasi_unit_link_v.kode_bagian_minta, dbo.mutasi_unit_link_v.nama_brg, dbo.mt_rekap_stok.harga_beli, dbo.mutasi_unit_link_v.harga
FROM         dbo.mt_rekap_stok INNER JOIN
                      dbo.mutasi_unit_link_v ON dbo.mt_rekap_stok.kode_brg = dbo.mutasi_unit_link_v.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_obatUnit_v]");
    }
};
