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
        DB::statement("CREATE OR ALTER VIEW dbo.kasir_obat_a_v
AS
SELECT     SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END) AS bi_apo, SUM(CASE WHEN lain_lain IS NULL THEN 0 ELSE lain_lain END) AS bi_lain, 
                      SUM(CASE WHEN bill_rs_jatah IS NULL THEN 0 ELSE bill_rs_jatah END) AS bi_apo_jatah, SUM(CASE WHEN lain_lain IS NULL 
                      THEN 0 ELSE lain_lain END) AS bi_lain_jatah, SUM(CASE WHEN jumlah IS NULL THEN 0 ELSE jumlah END) AS jumlah, kode_trans_far, kd_tr_resep, 
                      kode_tc_trans_kasir
FROM         dbo.tc_trans_pelayanan
WHERE     (kode_bagian = '060101') AND (status_kredit = 0 OR
                      status_kredit IS NULL) AND (status_batal IS NULL)
GROUP BY kode_trans_far, kd_tr_resep, kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kasir_obat_a_v]");
    }
};
