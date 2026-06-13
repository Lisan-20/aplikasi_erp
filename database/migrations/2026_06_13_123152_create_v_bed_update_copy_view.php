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
        DB::statement("CREATE VIEW dbo.v_bed_update_copy
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif_detail_bedah.kode, dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_master_tarif_detail_bedah.bill_rs, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1, dbo.mt_master_tarif_detail_bedah.bill_dr2, dbo.mt_master_tarif_detail_bedah.kode_tgl_tarif, 
                      dbo.v_bed_update.kode_tarif AS kode_tarif1, dbo.mt_master_tarif_detail_bedah.total, dbo.mt_master_tarif_detail_bedah.obat, 
                      dbo.mt_master_tarif_detail_bedah.alkes, dbo.mt_master_tarif_detail_bedah.alat_rs, dbo.mt_master_tarif_detail_bedah.adm, 
                      dbo.mt_master_tarif_detail_bedah.bhp, dbo.mt_master_tarif_detail_bedah.keterangan, dbo.mt_master_tarif_detail_bedah.pendapatan_rs, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr3, dbo.mt_master_tarif_detail_bedah.kamar_tindakan, dbo.mt_master_tarif_detail_bedah.paramedis, 
                      dbo.mt_master_tarif_detail_bedah.detail, dbo.mt_master_tarif_detail_bedah.no_urut, dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, 
                      dbo.v_bed_update.nama_tarif
FROM         dbo.mt_master_tarif_detail_bedah INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail_bedah.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.v_bed_update ON dbo.mt_master_tarif.referensi = dbo.v_bed_update.referensi
WHERE     (dbo.mt_master_tarif_detail_bedah.kode_klas = 3) AND (dbo.mt_master_tarif.referensi IN ('309010500', '309010600', '309030400', '309030400', 
                      '309030400', '309030400', '309030400', '309030400', '309030400', '309040200', '309040200', '309040500', '309040700', '309060100', '309060200', 
                      '309060200', '309060200', '309060200', '309060200', '309060200', '309060200', '309060400', '309060400', '309060400', '309060400', '309060400', 
                      '309060400', '309060400', '309060400', '309070100', '309070100', '309070100', '309070100', '309070100', '309070100', '309070200', '309070200', 
                      '309070200', '309070200', '309070200', '309070200', '309070200', '309070200', '309070200', '309070200', '309070200', '309070200', '309070200', 
                      '309070200', '309070200', '309070200', '309070200', '309070200', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', 
                      '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', 
                      '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', '309070300', 
                      '309070300', '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', 
                      '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', '309070400', 
                      '309070400', '309070400', '309080300', '309080300', '309080300', '309080300', '309080300', '309080400', '309080400', '309080400', '309080400', 
                      '309080400', '309080400', '309080400', '309080400', '309080400', '309080400', '309080400', '309080400', '309080400', '309090100', '309090100', 
                      '309090100', '309090100', '309090100', '309090100', '309090100', '309090100', '309090100', '309090100', '309090200', '309090200', '309090200', 
                      '309090300', '309090300', '309090300', '309090300', '309090300', '309090300', '309090300', '309090300', '309090300', '309090300', '309090300', 
                      '309090400', '309090400', '309090400', '309090400', '309090400', '309090400', '309090400', '309090400', '309090400', '309090400', '309090400', 
                      '309090400', '309090400', '309090400', '309090400', '309090400', '309090400', '309090400', '309090400', '309130100'))
ORDER BY dbo.mt_master_tarif.referensi, dbo.v_bed_update.nama_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_bed_update_copy]");
    }
};
