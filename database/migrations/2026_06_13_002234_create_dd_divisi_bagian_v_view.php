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
        DB::statement("
CREATE OR ALTER VIEW dbo.dd_divisi_bagian_v
AS
SELECT     dbo.dd_bagian_v.kode_level, dbo.dd_bagian_v.nama_struktur AS nama_bagian, dbo.dd_bagian_v.ko_wil, dbo.dd_bagian_v.kode_level_org, 
                      dbo.dd_bagian_v.jenis_struktur, dbo.dc_struktur_organisasi.nama_struktur AS nama_divisi, 
                      dbo.dc_struktur_organisasi.kode_level AS kode_level_divisi, dbo.dc_wilayah_kerja.nawil_kerja
FROM         dbo.dc_wilayah_kerja INNER JOIN
                      dbo.dc_struktur_organisasi ON dbo.dc_wilayah_kerja.ko_wil = dbo.dc_struktur_organisasi.ko_wil RIGHT OUTER JOIN
                      dbo.dd_bagian_v ON dbo.dc_struktur_organisasi.kode_level = dbo.dd_bagian_v.kode_level_ref

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dd_divisi_bagian_v]");
    }
};
