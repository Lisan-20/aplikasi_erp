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
        DB::statement("CREATE VIEW dbo.bpako_all_v
AS
SELECT     TOP (100) PERCENT SUM(a.bill_rs) AS harga, b.kode_brg, b.nama_brg, SUM(a.jumlah) AS keluar, a.kode_bagian, a.tgl_transaksi
FROM         dbo.tc_trans_pelayanan AS a INNER JOIN
                      dbo.mt_barang AS b ON b.kode_brg = a.kode_barang
WHERE     (a.jenis_tindakan = 9)
GROUP BY b.kode_brg, b.nama_brg, a.kode_bagian, a.tgl_transaksi
ORDER BY b.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bpako_all_v]");
    }
};
