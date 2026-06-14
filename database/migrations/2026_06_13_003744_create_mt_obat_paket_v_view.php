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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_obat_paket_v
AS
SELECT     dbo.mt_obat_paket_baru.id_mt_obat_paket, dbo.mt_obat_paket_baru.kode_tarif, dbo.mt_obat_paket_baru.kode_brg, dbo.mt_obat_paket_baru.jumlah, 
                      dbo.mt_obat_paket_baru.satuan, dbo.mt_obat_paket_baru.kode_bagian, dbo.mt_obat_paket_baru.nama_paket, dbo.mt_master_tarif.nama_tarif, 
                      dbo.mt_barang.nama_brg, dbo.mt_bagian.nama_bagian, dbo.mt_obat_paket_baru.harga
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_obat_paket_baru ON dbo.mt_bagian.kode_bagian = dbo.mt_obat_paket_baru.kode_bagian INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_obat_paket_baru.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_barang ON dbo.mt_obat_paket_baru.kode_brg = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_obat_paket_v]");
    }
};
