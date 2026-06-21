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
        DB::statement("CREATE OR ALTER VIEW dbo.v_obat_paket
AS
SELECT     kode_brg, nama_brg, kode_kategori, status_aktif
FROM         dbo.mt_barang
WHERE     (flag_promo = 1) AND (status_aktif = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_obat_paket]");
    }
};
