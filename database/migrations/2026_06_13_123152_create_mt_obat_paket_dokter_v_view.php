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
        DB::statement("CREATE VIEW dbo.mt_obat_paket_dokter_v
AS
SELECT     dbo.mt_obat_paket.kode_paket, dbo.mt_obat_paket.kode_dokter, dbo.mt_obat_paket.nama_paket, dbo.mt_obat_paket_dokter.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, 
                      dbo.mt_obat_paket_dokter.jumlah, dbo.mt_obat_paket_dokter.takaran, dbo.mt_obat_paket_dokter.penggunaan, dbo.mt_obat_paket_dokter.instruksi, dbo.mt_obat_paket_dokter.jml_pakai, 
                      dbo.mt_obat_paket_dokter.jml_takar, dbo.mt_obat_paket_dokter.id_mt_obat_dr, 2000 AS kode_profit, dbo.mt_obat_paket_dokter.komp_dtd, dbo.mt_obat_paket_dokter.racikan_obat_tambahan, 
                      dbo.mt_obat_paket_dokter.racik, dbo.mt_obat_paket_dokter.jml_konversi
FROM         dbo.mt_obat_paket INNER JOIN
                      dbo.mt_obat_paket_dokter ON dbo.mt_obat_paket.kode_paket = dbo.mt_obat_paket_dokter.kode_paket INNER JOIN
                      dbo.mt_barang ON dbo.mt_obat_paket_dokter.kode_brg = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_obat_paket_dokter_v]");
    }
};
