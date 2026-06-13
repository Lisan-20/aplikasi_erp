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
        DB::statement("CREATE VIEW dbo.mt_tarif_bedah_sum_v
AS
SELECT     dbo.mt_tarif_v.kode_tarif, dbo.mt_tarif_v.kode_klas, dbo.mt_tarif_v.nama_klas, dbo.mt_tarif_v.kode_bagian, dbo.mt_tarif_v.tingkatan, dbo.mt_tarif_v.jenis_tindakan, 
                      SUM(dbo.mt_master_tarif_detail_bedah.bill_rs) AS bill_rs, SUM(dbo.mt_master_tarif_detail_bedah.bill_dr1) AS bill_dr1, 
                      SUM(dbo.mt_master_tarif_detail_bedah.bill_dr2) AS bill_dr2, SUM(dbo.mt_master_tarif_detail_bedah.total) AS total, SUM(dbo.mt_master_tarif_detail_bedah.alat_rs) 
                      AS alat_rs, SUM(dbo.mt_master_tarif_detail_bedah.bhp) AS bhp, SUM(dbo.mt_master_tarif_detail_bedah.pendapatan_rs) AS pendapatan_rs, 
                      SUM(dbo.mt_master_tarif_detail_bedah.paramedis) AS paramedis, dbo.mt_master_tarif_detail_bedah.detail, dbo.mt_tarif_v.nama_tarif, COUNT(*) AS Expr1
FROM         dbo.mt_tarif_v INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_tarif_v.kode_klas = dbo.mt_master_tarif_detail_bedah.kode_klas AND 
                      dbo.mt_tarif_v.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif
GROUP BY dbo.mt_tarif_v.kode_tarif, dbo.mt_tarif_v.kode_klas, dbo.mt_tarif_v.nama_klas, dbo.mt_tarif_v.kode_bagian, dbo.mt_tarif_v.tingkatan, dbo.mt_tarif_v.jenis_tindakan, 
                      dbo.mt_master_tarif_detail_bedah.detail, dbo.mt_tarif_v.nama_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_bedah_sum_v]");
    }
};
