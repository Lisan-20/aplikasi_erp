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
        DB::statement("CREATE VIEW dbo.TOTAL_PENDAPATAN_ALKES_V
AS
SELECT     dbo.tc_trans_pelayanan.nama_tindakan, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.bill_rs_jatah IS NULL 
                      THEN 0 ELSE dbo.tc_trans_pelayanan.bill_rs_jatah END)) AS NOMINAL, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * (CASE WHEN dbo.tc_trans_pelayanan.diskon_rs IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_rs END)) AS DISKON, 
                      dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_barang ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_barang.kode_brg
WHERE     (dbo.tc_trans_pelayanan.kode_kelompok = 3) AND (dbo.mt_barang.kode_golongan LIKE 'E%')
GROUP BY dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.tgl_transaksi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [TOTAL_PENDAPATAN_ALKES_V]");
    }
};
