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
        DB::statement("CREATE VIEW dbo.mt_barang_kfa_v
AS
SELECT     dbo.mt_generik.kfa_code, dbo.mt_generik.nama_generik, dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.kfa_poa, dbo.mt_barang.kekuatan, dbo.mt_barang.satuan_kekuatan, 
                      dbo.mt_barang.[content], dbo.mt_barang.satuan_kecil, dbo.mt_barang.satuan_besar, dbo.mt_barang.status_aktif, dbo.mt_barang.flag_medis, dbo.mt_barang.id_obat, 
                      dbo.mt_generik.kode_generik
FROM         dbo.mt_barang LEFT OUTER JOIN
                      dbo.mt_generik ON dbo.mt_barang.kode_generik = dbo.mt_generik.kode_generik
GROUP BY dbo.mt_generik.nama_generik, dbo.mt_generik.kfa_code, dbo.mt_barang.nama_brg, dbo.mt_barang.kfa_poa, dbo.mt_barang.kode_brg, dbo.mt_barang.kekuatan, dbo.mt_barang.satuan_kekuatan, 
                      dbo.mt_barang.[content], dbo.mt_barang.satuan_kecil, dbo.mt_barang.satuan_besar, dbo.mt_barang.status_aktif, dbo.mt_barang.flag_medis, dbo.mt_barang.id_obat, dbo.mt_generik.kode_generik
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_barang_kfa_v]");
    }
};
