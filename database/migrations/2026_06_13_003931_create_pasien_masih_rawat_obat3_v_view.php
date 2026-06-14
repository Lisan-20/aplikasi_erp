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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_masih_rawat_obat3_v
AS
SELECT     dbo.pasien_masih_rawat_obat2_v.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil
FROM         dbo.pasien_masih_rawat_obat2_v INNER JOIN
                      dbo.mt_barang ON dbo.pasien_masih_rawat_obat2_v.kode_brg = dbo.mt_barang.kode_brg
GROUP BY dbo.pasien_masih_rawat_obat2_v.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_masih_rawat_obat3_v]");
    }
};
