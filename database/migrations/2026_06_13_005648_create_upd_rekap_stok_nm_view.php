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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_rekap_stok_nm
AS
SELECT     dbo.mt_rekap_stok_nm.kode_brg, dbo.mt_barang_jasa_old.nama_brg
FROM         dbo.mt_rekap_stok_nm INNER JOIN
                      dbo.mt_barang_jasa_old ON dbo.mt_rekap_stok_nm.kode_brg = dbo.mt_barang_jasa_old.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_rekap_stok_nm]");
    }
};
