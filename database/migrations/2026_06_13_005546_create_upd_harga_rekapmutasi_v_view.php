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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_harga_rekapmutasi_v
AS
SELECT     dbo.mutasi_unit_link_v.kode_bagian_kirim, dbo.mutasi_unit_link_v.kode_bagian_minta, dbo.mutasi_unit_link_v.nama_brg, dbo.mutasi_unit_link_v.kode_brg, dbo.mutasi_unit_link_v.satuan, 
                      dbo.mutasi_unit_link_v.jumlah_permintaan, dbo.mutasi_unit_link_v.jumlah_penerimaan, dbo.mutasi_unit_link_v.harga, dbo.mt_rekap_stok.harga_beli, dbo.mt_rekap_stok.harga_persediaan
FROM         dbo.mutasi_unit_link_v INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mutasi_unit_link_v.kode_brg = dbo.mt_rekap_stok.kode_brg
WHERE     (dbo.mutasi_unit_link_v.harga IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_rekapmutasi_v]");
    }
};
