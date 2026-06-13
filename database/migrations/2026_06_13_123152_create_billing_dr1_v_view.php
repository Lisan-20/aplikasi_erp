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
        DB::statement("CREATE VIEW dbo.billing_dr1_v
AS
SELECT     no_registrasi, SUM(bill_dr1) AS bill_dr, SUM(bill_dr1_jatah) AS bill_dr_jatah, kode_dokter1 AS kode_dokter, SUM(bill_rs) AS bill_rs, SUM(bill_rs_jatah) AS bill_rs_jatah,
                       kode_kelompok, status_selesai, kode_tc_trans_kasir, SUM(jumlah) AS jumlah
FROM         dbo.tc_trans_pelayanan
GROUP BY no_registrasi, kode_dokter1, status_batal, status_selesai, jenis_tindakan, kode_bagian, kode_kelompok, kode_tc_trans_kasir
HAVING      (status_batal IS NULL) AND (jenis_tindakan IN (4, 12)) AND (kode_bagian LIKE '03%') AND (kode_bagian NOT IN ('030501', '030901')) AND (kode_dokter1 > '0')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [billing_dr1_v]");
    }
};
