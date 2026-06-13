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
        DB::statement("CREATE VIEW dbo.obat_baru_v
AS
SELECT     no, kode AS kode_brg, '-' AS kode_pabrik, NULL AS kode_generik, nama_obat AS nama_brg, 'E' AS kode_kategori, satuan AS satuan_besar, satuan AS satuan_kecil, '0' AS flag_medis, 
                      'E01' AS kode_golongan, '148' AS id_pabrik, 'M' AS kode_layanan, '2' AS obat_khusus, '1' AS kode_jenis, '1' AS content, harga_ppn AS harga_satuan, '2' AS kode_rotasi, '225' AS kode_supplier, 
                      'A' AS gol_obat, golongan, kategori, jenis, harga, ppn, harga_ppn
FROM         dbo.obat_lagi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_baru_v]");
    }
};
