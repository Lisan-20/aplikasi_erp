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
        DB::statement("CREATE VIEW dbo.mt_rl_313_v
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_rl_313.kode_golongan, dbo.mt_barang.kode_sub_golongan, dbo.mt_rl_313.nama_golongan, dbo.tc_trans_pelayanan.jumlah, 
                      MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_rl_313 ON dbo.mt_barang.kode_golongan = dbo.mt_rl_313.kode_golongan INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_barang.kode_brg = dbo.tc_trans_pelayanan.kode_barang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_rl_313_v]");
    }
};
