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
        DB::statement("CREATE OR ALTER VIEW dbo.obat_paket_sc_v
AS
SELECT     TOP (200) id_mt_obat_paket, kode_tarif, kode_brg, jumlah, satuan, kode_bagian, nama_paket, nama_brg, harga
FROM         dbo.mt_obat_paket_baru
WHERE     (kode_tarif = 309040107)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_paket_sc_v]");
    }
};
