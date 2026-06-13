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
        DB::statement("CREATE OR ALTER VIEW dbo.v_billing_inheat_pelayanan_sum
AS
SELECT     SUM(dbo.v_billing_inheat_pelayanan.bill_rs) AS bill_rs, SUM(dbo.v_billing_inheat_pelayanan.bill_dr1) AS bill_dr1, SUM(dbo.v_billing_inheat_pelayanan.bill_dr2) AS bill_dr2, 
                      SUM(dbo.v_billing_inheat_pelayanan.bill_rs + dbo.v_billing_inheat_pelayanan.bill_dr1 + dbo.v_billing_inheat_pelayanan.bill_dr2) AS jumlah_tagih, 
                      dbo.v_billing_inheat_pelayanan.kode_tc_trans_kasir, dbo.v_billing_inheat_pelayanan.kode_barang, dbo.v_billing_inheat_pelayanan.kode_perusahaan, dbo.v_billing_inheat_pelayanan.tgl_jam, 
                      dbo.mt_perusahaan.nama_perusahaan
FROM         dbo.v_billing_inheat_pelayanan INNER JOIN
                      dbo.mt_perusahaan ON dbo.v_billing_inheat_pelayanan.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
GROUP BY dbo.v_billing_inheat_pelayanan.kode_tc_trans_kasir, dbo.v_billing_inheat_pelayanan.kode_barang, dbo.v_billing_inheat_pelayanan.kode_perusahaan, dbo.v_billing_inheat_pelayanan.tgl_jam, 
                      dbo.mt_perusahaan.nama_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_billing_inheat_pelayanan_sum]");
    }
};
