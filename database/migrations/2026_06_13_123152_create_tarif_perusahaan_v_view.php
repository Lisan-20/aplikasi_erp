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
        DB::statement("CREATE VIEW dbo.tarif_perusahaan_v
AS
SELECT     dbo.mt_master_tarif_detail.kode_master_tarif_detail, dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.bill_rs, dbo.mt_master_tarif_detail.bill_dr1, 
                      dbo.mt_master_tarif_detail.bill_dr2, dbo.mt_master_tarif_detail.kode_tgl_tarif, dbo.mt_master_tarif_detail.kode_tarif, dbo.mt_master_tarif_detail.total, 
                      dbo.mt_master_tarif_detail.obat, dbo.mt_master_tarif_detail.alkes, dbo.mt_master_tarif_detail.alat_rs, dbo.mt_master_tarif_detail.adm, 
                      dbo.mt_master_tarif_detail.marketing, dbo.mt_master_tarif_detail.bhp, dbo.mt_master_tarif_detail.keterangan, dbo.mt_master_tarif_detail.pendapatan_rs, 
                      dbo.mt_master_tarif_detail.bill_dr3, dbo.mt_master_tarif_detail.kamar_tindakan, dbo.mt_master_tarif_detail.reagen, dbo.mt_master_tarif_detail.paramedis, 
                      dbo.mt_master_tarif_detail.flag_spec, dbo.mt_perusahaan.kode_perusahaan
FROM         dbo.mt_master_tarif_detail CROSS JOIN
                      dbo.mt_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tarif_perusahaan_v]");
    }
};
