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
        DB::statement("CREATE VIEW dbo.upd_harga_mt_brg_v
AS
SELECT     dbo.tbl_detail_so.kode_brg, dbo.tbl_detail_so.harga_satuan, dbo.mt_rekap_stok.harga_beli
FROM         dbo.mt_rekap_stok INNER JOIN
                      dbo.tbl_detail_so ON dbo.mt_rekap_stok.kode_brg = dbo.tbl_detail_so.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_mt_brg_v]");
    }
};
