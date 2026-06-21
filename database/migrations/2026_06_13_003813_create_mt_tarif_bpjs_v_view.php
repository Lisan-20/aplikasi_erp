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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_tarif_bpjs_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_bpjs.kode_klas, dbo.mt_klas.nama_klas, 
                      dbo.mt_master_tarif_detail_bpjs.bill_rs, dbo.mt_master_tarif_detail_bpjs.bill_dr1, dbo.mt_master_tarif_detail_bpjs.bill_dr2, dbo.mt_master_tarif_detail_bpjs.total, 
                      dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.tingkatan, dbo.mt_tgl_tarif.kode_tgl_tarif, dbo.mt_tgl_tarif.status, 
                      dbo.mt_master_tarif_detail_bpjs.kode_master_tarif_detail, dbo.mt_master_tarif.jenis_tindakan, dbo.mt_master_tarif_detail_bpjs.bhp, 
                      dbo.mt_master_tarif_detail_bpjs.pendapatan_rs, dbo.mt_master_tarif.kode_tindakan, dbo.mt_master_tarif_detail_bpjs.bill_rs_rujukan, 
                      dbo.mt_master_tarif_detail_bpjs.bill_dr3
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_bpjs ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_bpjs.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail_bpjs.kode_klas = dbo.mt_klas.kode_klas LEFT OUTER JOIN
                      dbo.mt_tgl_tarif ON dbo.mt_master_tarif_detail_bpjs.kode_tgl_tarif = dbo.mt_tgl_tarif.kode_tgl_tarif
WHERE     (dbo.mt_tgl_tarif.status = 1) AND (dbo.mt_master_tarif.tingkatan = 5)
ORDER BY dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif_detail_bpjs.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_bpjs_v]");
    }
};
