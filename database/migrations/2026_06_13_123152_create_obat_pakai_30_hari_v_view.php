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
        DB::statement("CREATE VIEW dbo.obat_pakai_30_hari_v
AS
SELECT     no_registrasi, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_rs_jatah) AS rs, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * lain_lain) AS lain_lain, status_kredit, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * diskon_rs_jatah) AS diskon_rs_jatah, kode_barang, status_selesai, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * jumlah) AS jumlah, DAY(tgl_transaksi) AS tgl, MONTH(tgl_transaksi) AS bln, YEAR(tgl_transaksi) AS thn
FROM         dbo.tc_trans_pelayanan
GROUP BY no_registrasi, status_batal, status_kredit, kode_barang, status_selesai, DAY(tgl_transaksi), MONTH(tgl_transaksi), YEAR(tgl_transaksi)
HAVING      (status_batal IS NULL) AND (kode_barang <> '') AND (status_selesai > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_pakai_30_hari_v]");
    }
};
