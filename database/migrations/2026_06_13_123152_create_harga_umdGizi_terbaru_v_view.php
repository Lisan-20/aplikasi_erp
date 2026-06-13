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
        DB::statement("CREATE OR ALTER VIEW dbo.harga_umdGizi_terbaru_v
AS
SELECT     dbo.transaksi_umd.tgl_transaksi, dbo.transaksi_umd_detail.kode_brg, dbo.transaksi_umd_detail.jumlah_besar_gizi, dbo.transaksi_umd_detail.[content], dbo.transaksi_umd_detail.harga_satuan, 
                      dbo.transaksi_umd_detail.jumlah_harga, dbo.transaksi_umd_detail.discount, dbo.transaksi_umd_detail.pilih_satuan, dbo.transaksi_umd_detail.satuan
FROM         dbo.transaksi_umd INNER JOIN
                      dbo.transaksi_umd_detail ON dbo.transaksi_umd.id_trans_umd = dbo.transaksi_umd_detail.id_trans_umd
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [harga_umdGizi_terbaru_v]");
    }
};
