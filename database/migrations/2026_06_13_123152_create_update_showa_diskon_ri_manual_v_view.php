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
        DB::statement("CREATE VIEW dbo.update_showa_diskon_ri_manual_v
AS
SELECT     kode_perusahaan, no_registrasi, status_batal, bill_rs_jatah, bill_dr1_jatah, bill_dr2_jatah, lain_lain, status_kredit, diskon_rs_jatah, diskon_dr1_jatah, 
                      diskon_dr2_jatah, CAST(CASE WHEN bill_rs_jatah IS NULL THEN 0 ELSE bill_rs_jatah END + CASE WHEN bill_dr1_jatah IS NULL 
                      THEN 0 ELSE bill_dr1_jatah END + CASE WHEN bill_dr2_jatah IS NULL THEN 0 ELSE bill_dr2_jatah END + CASE WHEN lain_lain IS NULL 
                      THEN 0 ELSE lain_lain END AS money) AS diskon_total, kode_bagian
FROM         dbo.tc_trans_pelayanan
WHERE     (kode_perusahaan = 171) AND (status_batal IS NULL) AND (kode_bagian_asal LIKE '03%') AND (no_registrasi IN (17903, 17772))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_showa_diskon_ri_manual_v]");
    }
};
