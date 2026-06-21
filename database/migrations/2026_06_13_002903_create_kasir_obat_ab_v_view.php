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
        DB::statement("CREATE OR ALTER VIEW dbo.kasir_obat_ab_v
AS
SELECT     dbo.kasir_obat_a_v.kode_trans_far, dbo.kasir_obat_a_v.kode_tc_trans_kasir, dbo.kasir_obat_a_v.bi_apo - dbo.kasir_obat_b_v.bi_apo_ret AS bill_rs, 
                      dbo.kasir_obat_a_v.bi_lain - dbo.kasir_obat_b_v.bi_lain_ret AS lain_lain, 
                      dbo.kasir_obat_a_v.bi_apo_jatah - dbo.kasir_obat_b_v.bi_apo_ret_jatah AS bill_rs_jatah, 
                      dbo.kasir_obat_a_v.jumlah - dbo.kasir_obat_b_v.jumlah_ret AS jumlah
FROM         dbo.kasir_obat_a_v INNER JOIN
                      dbo.kasir_obat_b_v ON dbo.kasir_obat_a_v.kd_tr_resep = dbo.kasir_obat_b_v.kd_tr_resep AND 
                      dbo.kasir_obat_a_v.kode_trans_far = dbo.kasir_obat_b_v.kode_trans_far AND 
                      dbo.kasir_obat_a_v.kode_tc_trans_kasir = dbo.kasir_obat_b_v.kode_tc_trans_kasir
WHERE     (dbo.kasir_obat_a_v.jumlah - dbo.kasir_obat_b_v.jumlah_ret > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kasir_obat_ab_v]");
    }
};
