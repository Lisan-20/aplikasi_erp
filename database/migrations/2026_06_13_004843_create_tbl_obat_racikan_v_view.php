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
        DB::statement("CREATE OR ALTER VIEW dbo.tbl_obat_racikan_v
AS
SELECT     dbo.mt_barang.nama_brg, dbo.tbl_obat_racikan_temp.kode_brg_racikan, dbo.tbl_obat_racikan_temp.harga, dbo.tbl_obat_racikan_temp.jumlah, 
                      dbo.tbl_obat_racikan_temp.kode_trans_far, dbo.tbl_obat_racikan_temp.user_id, dbo.tbl_obat_racikan_temp.status_kirim, 
                      dbo.tbl_obat_racikan_temp.jumlah_kirim
FROM         dbo.mt_barang INNER JOIN
                      dbo.tbl_obat_racikan_temp ON dbo.mt_barang.kode_brg = dbo.tbl_obat_racikan_temp.kode_brg_racikan
GROUP BY dbo.mt_barang.nama_brg, dbo.tbl_obat_racikan_temp.kode_brg_racikan, dbo.tbl_obat_racikan_temp.harga, dbo.tbl_obat_racikan_temp.jumlah, 
                      dbo.tbl_obat_racikan_temp.kode_trans_far, dbo.tbl_obat_racikan_temp.user_id, dbo.tbl_obat_racikan_temp.status_kirim, 
                      dbo.tbl_obat_racikan_temp.jumlah_kirim
HAVING      (dbo.tbl_obat_racikan_temp.status_kirim = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tbl_obat_racikan_v]");
    }
};
