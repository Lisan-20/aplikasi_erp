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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_brg_v
AS
SELECT     TOP (100) PERCENT kode_brg, kode_pabrik, kode_generik, nama_brg, kode_kategori, satuan_besar, satuan_kecil, flag_medis, jenis_askes, kode_sub_golongan, 
                      kode_golongan, id_pabrik, kode_layanan, obat_khusus, kode_jenis, [content], harga_satuan, kode_rotasi, kode_supplier, sub_content, satuan_plg_kecil, on_rp, 
                      on_persen, off_rp, off_persen, diskon_on, diskon_off, status_aktif, flag_prod, kode_brg_ref
FROM         dbo.mt_barang
WHERE     (nama_brg <> '')
ORDER BY nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_brg_v]");
    }
};
