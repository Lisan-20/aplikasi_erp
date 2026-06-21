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
        DB::statement("CREATE OR ALTER VIEW dbo.v_billing_inheat_obat_sum
AS
SELECT     SUM(dbo.v_billing_inheat_obat.bill_rs_jatah) AS bill_rs_jatah, SUM(dbo.v_billing_inheat_obat.bill_dr1_jatah) AS bill_dr1_jatah, 
                      SUM(dbo.v_billing_inheat_obat.bill_dr2_jatah) AS bill_dr2_jatah, dbo.v_billing_inheat_obat.kode_tc_trans_kasir, 
                      dbo.v_billing_inheat_obat.kode_perusahaan, dbo.v_billing_inheat_obat.tgl_jam, dbo.mt_perusahaan.nama_perusahaan
FROM         dbo.v_billing_inheat_obat INNER JOIN
                      dbo.mt_perusahaan ON dbo.v_billing_inheat_obat.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
GROUP BY dbo.v_billing_inheat_obat.kode_tc_trans_kasir, dbo.v_billing_inheat_obat.kode_perusahaan, dbo.v_billing_inheat_obat.tgl_jam, 
                      dbo.mt_perusahaan.nama_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_billing_inheat_obat_sum]");
    }
};
