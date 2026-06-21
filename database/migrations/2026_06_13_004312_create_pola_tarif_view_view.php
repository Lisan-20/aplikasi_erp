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
        DB::statement("CREATE OR ALTER VIEW dbo.pola_tarif_view
AS
SELECT     dbo.mt_perusahaan.nama_perusahaan, dbo.mt_klas.nama_klas, dbo.mt_bagian.nama_bagian, dbo.mt_jenis_tindakan.jenis_tindakan, 
                      dbo.mt_pola_tarif.kode_perusahaan, dbo.mt_pola_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_pola_tarif.bill_rs, dbo.mt_pola_tarif.bill_dr1, 
                      dbo.mt_pola_tarif.kode_bagian, dbo.mt_pola_tarif.kode_klas, dbo.mt_pola_tarif.kode_jenis_tindakan, dbo.mt_pola_tarif.id_pola_tarif, 
                      dbo.mt_master_tarif_detail_perusahaan.kode_master_tarif_detail, dbo.mt_master_tarif_detail_perusahaan.bill_dr2
FROM         dbo.mt_perusahaan INNER JOIN
                      dbo.mt_pola_tarif ON dbo.mt_perusahaan.kode_perusahaan = dbo.mt_pola_tarif.kode_perusahaan INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_pola_tarif.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_bagian ON dbo.mt_pola_tarif.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_klas ON dbo.mt_pola_tarif.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_jenis_tindakan ON dbo.mt_pola_tarif.kode_jenis_tindakan = dbo.mt_jenis_tindakan.kode_jenis_tindakan INNER JOIN
                      dbo.mt_master_tarif_detail_perusahaan ON dbo.mt_pola_tarif.kode_klas = dbo.mt_master_tarif_detail_perusahaan.kode_klas AND 
                      dbo.mt_pola_tarif.kode_tarif = dbo.mt_master_tarif_detail_perusahaan.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pola_tarif_view]");
    }
};
