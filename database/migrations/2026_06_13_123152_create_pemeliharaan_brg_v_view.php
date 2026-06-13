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
        DB::statement("CREATE VIEW dbo.pemeliharaan_brg_v
AS
SELECT     dbo.mt_depo_stok_nm.kode_brg, dbo.mt_barang_nm.nama_brg, dbo.mt_bagian.nama_bagian, dbo.mt_barang_nm.inv_tehnik, dbo.mt_barang_nm.satuan_kecil, dbo.mt_depo_stok_nm.jml_sat_kcl, 
                      dbo.mt_depo_stok_nm.kode_depo_stok, dbo.mt_bagian.kode_bagian
FROM         dbo.mt_depo_stok_nm INNER JOIN
                      dbo.mt_bagian ON dbo.mt_depo_stok_nm.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_barang_nm ON dbo.mt_depo_stok_nm.kode_brg = dbo.mt_barang_nm.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pemeliharaan_brg_v]");
    }
};
