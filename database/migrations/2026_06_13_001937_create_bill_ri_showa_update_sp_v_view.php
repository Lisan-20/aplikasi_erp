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
        DB::statement("CREATE OR ALTER VIEW dbo.bill_ri_showa_update_sp_v
AS
SELECT     kode_perusahaan, no_registrasi, status_batal, bill_rs_jatah, bill_dr1_jatah, bill_dr2_jatah, lain_lain, status_kredit, diskon_rs_jatah, diskon_dr1_jatah, 
                      diskon_dr2_jatah, CAST(bill_rs_jatah + bill_dr1_jatah + lain_lain AS int) AS diskon_total, kode_bagian
FROM         dbo.tc_trans_pelayanan
WHERE     (kode_perusahaan = 171) AND (status_batal IS NULL) AND (kode_tc_trans_kasir IS NULL OR
                      kode_tc_trans_kasir = 0) AND (kode_bagian_asal LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_ri_showa_update_sp_v]");
    }
};
