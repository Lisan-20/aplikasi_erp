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
        DB::statement("CREATE OR ALTER VIEW dbo.UPDATE_LAB
AS
SELECT     TOP (100) PERCENT kode_tc_trans_kasir, no_kunjungan, no_registrasi, no_mr, kode_kelompok, kode_perusahaan, tgl_transaksi, jenis_tindakan, 
                      nama_tindakan, bill_rs, bill_dr1, bill_rs_jatah, bill_dr1_jatah, kode_dokter1, jumlah, bill_rs_jatah - 25000 AS rs, 25000 AS dr
FROM         dbo.tc_trans_pelayanan
WHERE     (nama_tindakan LIKE '%PENATA%') AND (kode_kelompok IN (8, 9, 10)) AND (jenis_tindakan <> 8) AND (bill_dr1_jatah = 0)
ORDER BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [UPDATE_LAB]");
    }
};
