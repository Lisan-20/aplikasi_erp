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
        DB::statement("CREATE VIEW dbo.billing_dr_v
AS
SELECT     no_registrasi, sum(bill_dr) AS bill_dr, sum(bill_dr_jatah) AS bill_dr_jatah, kode_dokter, sum(bill_rs) AS bill_rs, sum(bill_rs_jatah) AS bill_rs_jatah, kode_kelompok, status_selesai, 
                      kode_tc_trans_kasir, sum(jumlah) AS jumlah

FROM         billing_dr1_v
GROUP BY no_registrasi, kode_dokter, kode_kelompok, status_selesai, kode_tc_trans_kasir
UNION
SELECT     no_registrasi, sum(bill_dr) AS bill_dr, sum(bill_dr_jatah) AS bill_dr_jatah, kode_dokter, sum(bill_rs) AS bill_rs, sum(bill_rs_jatah) AS bill_rs_jatah, kode_kelompok, status_selesai, 
                      kode_tc_trans_kasir, sum(jumlah) AS jumlah


FROM         billing_dr2_v
GROUP BY no_registrasi, kode_dokter, kode_kelompok, status_selesai, kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [billing_dr_v]");
    }
};
