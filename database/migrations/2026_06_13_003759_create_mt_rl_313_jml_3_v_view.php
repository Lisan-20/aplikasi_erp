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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_rl_313_jml_3_v
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_rl_313.kode_golongan, dbo.mt_barang.kode_sub_golongan, dbo.mt_rl_313.nama_golongan, dbo.tc_kartu_stok.stok_akhir, 
                      dbo.tc_kartu_stok.tgl_input
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_rl_313 ON dbo.mt_barang.kode_golongan = dbo.mt_rl_313.kode_golongan INNER JOIN
                      dbo.tc_kartu_stok ON dbo.mt_barang.kode_brg = dbo.tc_kartu_stok.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_rl_313_jml_3_v]");
    }
};
