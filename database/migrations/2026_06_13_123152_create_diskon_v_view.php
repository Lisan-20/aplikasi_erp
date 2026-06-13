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
        DB::statement("CREATE VIEW dbo.diskon_v
AS
SELECT     dbo.mt_perusahaan.nama_perusahaan, dbo.mt_klas.nama_klas, dbo.mt_bagian.nama_bagian, dbo.mt_pola_diskon.kode_perusahaan, dbo.mt_bagian.kode_bagian, 
                      dbo.mt_klas.kode_klas, dbo.mt_pola_diskon.diskon, dbo.mt_pola_diskon.diskon_dr_part, dbo.mt_pola_diskon.diskon_dr_full, dbo.mt_jenis_tindakan.jenis_tindakan, 
                      dbo.mt_jenis_tindakan.kode_jenis_tindakan AS kode_tindakan, dbo.mt_pola_diskon.kd_pola_diskon
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_pola_diskon ON dbo.mt_bagian.kode_bagian = dbo.mt_pola_diskon.kode_bagian INNER JOIN
                      dbo.mt_perusahaan ON dbo.mt_pola_diskon.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan INNER JOIN
                      dbo.mt_klas ON dbo.mt_pola_diskon.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_jenis_tindakan ON dbo.mt_pola_diskon.kode_jenis_tindakan = dbo.mt_jenis_tindakan.kode_jenis_tindakan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [diskon_v]");
    }
};
