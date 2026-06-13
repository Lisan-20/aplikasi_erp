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
        DB::statement("CREATE OR ALTER VIEW dbo.pola_diskon_tarif_v
AS
SELECT     dbo.mt_pola_diskon.kd_pola_diskon, dbo.mt_pola_diskon.kode_perusahaan, dbo.mt_pola_diskon.kode_klas, dbo.mt_pola_diskon.kd_jenis_diskon, 
                      dbo.mt_pola_diskon.kode_bagian, dbo.mt_pola_diskon_tarif.diskon, dbo.mt_pola_diskon_tarif.diskon_dr_part, 
                      dbo.mt_pola_diskon_tarif.diskon_dr_full, dbo.mt_pola_diskon_tarif.diskon_rs, dbo.mt_pola_diskon_tarif.diskon_dr1, 
                      dbo.mt_pola_diskon_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_jenis_tindakan.jenis_tindakan, dbo.mt_klas.nama_klas, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_perusahaan.nama_perusahaan, dbo.mt_pola_diskon_tarif.kd_pola_diskon_tarif
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_pola_diskon_tarif ON dbo.mt_master_tarif.kode_tarif = dbo.mt_pola_diskon_tarif.kode_tarif RIGHT OUTER JOIN
                      dbo.mt_bagian INNER JOIN
                      dbo.mt_jenis_tindakan INNER JOIN
                      dbo.mt_pola_diskon ON dbo.mt_jenis_tindakan.kode_jenis_tindakan = dbo.mt_pola_diskon.kode_jenis_tindakan INNER JOIN
                      dbo.mt_klas ON dbo.mt_pola_diskon.kode_klas = dbo.mt_klas.kode_klas ON 
                      dbo.mt_bagian.kode_bagian = dbo.mt_pola_diskon.kode_bagian INNER JOIN
                      dbo.mt_perusahaan ON dbo.mt_pola_diskon.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan ON 
                      dbo.mt_pola_diskon_tarif.kd_pola_diskon = dbo.mt_pola_diskon.kd_pola_diskon
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pola_diskon_tarif_v]");
    }
};
