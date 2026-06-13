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
        DB::statement("CREATE VIEW dbo.upd_stok_depo_v
AS
SELECT     TOP (100) PERCENT SUM(dbo.tc_trans_pelayanan.jumlah) AS jumlah, dbo.tc_trans_pelayanan.kode_barang, dbo.mt_depo_stok.jml_sat_kcl, 
                      dbo.mt_depo_stok.jml_sat_kcl - SUM(dbo.tc_trans_pelayanan.jumlah) AS jml
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_depo_stok ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_depo_stok.kode_brg
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 9) AND (dbo.tc_trans_pelayanan.kode_bagian = '030901') AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 10) AND 
                      (dbo.mt_depo_stok.kode_bagian = '030901') AND (dbo.tc_trans_pelayanan.nama_tindakan NOT LIKE 'cendo%') AND 
                      (dbo.tc_trans_pelayanan.kode_barang NOT IN ('E03B0303', 'E01A1998', 'E01A1959', 'E01A1923', 'E01A1880', 'E01A1826', 'E01A1814'))
GROUP BY dbo.tc_trans_pelayanan.kode_barang, dbo.mt_depo_stok.jml_sat_kcl
ORDER BY dbo.tc_trans_pelayanan.kode_barang DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_stok_depo_v]");
    }
};
