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
        DB::statement("CREATE VIEW dbo.diskon_flat_ri_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.diskon_rs_jatah, 
                      dbo.tc_trans_pelayanan.diskon_dr1_jatah, dbo.tc_trans_pelayanan.diskon_dr2_jatah, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.mt_diskon_flat_perusahaan.diskon_ri, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah, 
                      SUBSTRING(dbo.tc_trans_pelayanan.kode_bagian, 0, 3) AS bagian, CAST(dbo.mt_diskon_flat_perusahaan.diskon_ri / 100 * dbo.tc_trans_pelayanan.bill_rs_jatah AS int) AS disk_rs, 
                      CAST(dbo.mt_diskon_flat_perusahaan.diskon_ri / 100 * dbo.tc_trans_pelayanan.bill_dr1_jatah AS int) AS disk_dr1, 
                      CAST(dbo.mt_diskon_flat_perusahaan.diskon_ri / 100 * dbo.tc_trans_pelayanan.bill_dr2_jatah AS int) AS disk_dr2, dbo.tc_trans_pelayanan.no_kamar, dbo.tc_trans_pelayanan.no_bed
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_diskon_flat_perusahaan ON dbo.tc_trans_pelayanan.kode_perusahaan = dbo.mt_diskon_flat_perusahaan.kode_perusahaan
WHERE     (SUBSTRING(dbo.tc_trans_pelayanan.kode_bagian, 0, 3) = '03') AND (dbo.tc_trans_pelayanan.diskon_rs_jatah = 0) OR
                      (SUBSTRING(dbo.tc_trans_pelayanan.kode_bagian, 0, 3) = '03') AND (dbo.tc_trans_pelayanan.diskon_dr1_jatah = 0) OR
                      (SUBSTRING(dbo.tc_trans_pelayanan.kode_bagian, 0, 3) = '03') AND (dbo.tc_trans_pelayanan.diskon_dr2_jatah = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [diskon_flat_ri_v]");
    }
};
