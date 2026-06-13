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
        DB::statement("CREATE VIEW dbo.mt_tarif_jamkesmas_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_jamkesmas.kode_klas, dbo.mt_klas.nama_klas, 
                      dbo.mt_master_tarif_detail_jamkesmas.bill_rs, dbo.mt_master_tarif_detail_jamkesmas.bill_dr1, dbo.mt_master_tarif_detail_jamkesmas.bill_dr2, 
                      dbo.mt_master_tarif_detail_jamkesmas.total, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.tingkatan, dbo.mt_tgl_tarif.kode_tgl_tarif, dbo.mt_tgl_tarif.status, 
                      dbo.mt_master_tarif_detail_jamkesmas.kode_master_tarif_detail, dbo.mt_master_tarif.jenis_tindakan, dbo.mt_master_tarif_detail_jamkesmas.alkes, 
                      dbo.mt_master_tarif_detail_jamkesmas.bhp, dbo.mt_master_tarif_detail_jamkesmas.pendapatan_rs, dbo.mt_master_tarif_detail_jamkesmas.paramedis, 
                      dbo.mt_master_tarif.kode_tindakan, dbo.mt_master_tarif_detail_jamkesmas.bill_rs_spesialis, dbo.mt_master_tarif_detail_jamkesmas.bill_dr1_spesialis, 
                      dbo.mt_master_tarif_detail_jamkesmas.bill_dr2_spesialis, dbo.mt_master_tarif_detail_jamkesmas.pendapatan_rs_spesialis, 
                      dbo.mt_master_tarif_detail_jamkesmas.total_spesialis, dbo.mt_master_tarif_detail_jamkesmas.bill_rs_rujukan, dbo.mt_master_tarif_detail_jamkesmas.sewa_alat, 
                      dbo.mt_master_tarif_detail_jamkesmas.kamar_tindakan, dbo.mt_master_tarif_detail_jamkesmas.bill_dr3
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_jamkesmas ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_jamkesmas.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail_jamkesmas.kode_klas = dbo.mt_klas.kode_klas LEFT OUTER JOIN
                      dbo.mt_tgl_tarif ON dbo.mt_master_tarif_detail_jamkesmas.kode_tgl_tarif = dbo.mt_tgl_tarif.kode_tgl_tarif
WHERE     (dbo.mt_tgl_tarif.status = 1) AND (dbo.mt_master_tarif.tingkatan = 5)
ORDER BY dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif_detail_jamkesmas.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_jamkesmas_v]");
    }
};
