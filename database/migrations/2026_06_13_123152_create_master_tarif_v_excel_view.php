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
        DB::statement("CREATE VIEW dbo.master_tarif_v_excel
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.nama_tarif, dbo.mt_tarif_v.nama_klas, dbo.mt_bagian.nama_bagian, dbo.mt_tarif_v.bill_rs, dbo.mt_tarif_v.bill_dr1, dbo.mt_tarif_v.bill_dr2, 
                      dbo.mt_tarif_v.total, dbo.mt_tarif_v.bill_rs_bpjs, dbo.mt_tarif_v.bill_dr1_bpjs, dbo.mt_tarif_v.bill_dr2_bpjs, dbo.mt_tarif_v.total_bpjs, dbo.mt_tarif_v.bill_rs_ass, dbo.mt_tarif_v.bill_dr1_ass, 
                      dbo.mt_tarif_v.bill_dr2_ass, dbo.mt_tarif_v.total_ass, dbo.mt_tarif_v.bill_rs_pt, dbo.mt_tarif_v.bill_dr1_pt, dbo.mt_tarif_v.bill_dr2_pt, dbo.mt_tarif_v.total_pt
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_tarif_v ON dbo.mt_bagian.kode_bagian = dbo.mt_tarif_v.kode_bagian INNER JOIN
                      dbo.mt_tgl_tarif ON dbo.mt_tarif_v.kode_tgl_tarif = dbo.mt_tgl_tarif.kode_tgl_tarif RIGHT OUTER JOIN
                      dbo.mt_master_tarif ON dbo.mt_tarif_v.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.mt_master_tarif.tingkatan = 5) AND (dbo.mt_master_tarif.jenis_tindakan = 3)
ORDER BY dbo.mt_master_tarif.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [master_tarif_v_excel]");
    }
};
