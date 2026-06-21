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
        DB::statement("CREATE OR ALTER VIEW dbo.perusahaan_v
AS
SELECT     dbo.mt_perusahaan.id_perusahaan, dbo.mt_perusahaan.kode_pola, dbo.mt_perusahaan.nama_perusahaan, dbo.mt_perusahaan.alamat, dbo.mt_perusahaan.kodepos, dbo.mt_perusahaan.telpon1, 
                      dbo.mt_perusahaan.telpon2, dbo.mt_perusahaan.kontakperson, dbo.mt_perusahaan.fax, dbo.mt_perusahaan.kontakperson2, dbo.mt_perusahaan.kelurahan, dbo.mt_perusahaan.kecamatan, 
                      dbo.mt_perusahaan.flag_status, dbo.dc_kota.nama_kota, dbo.dc_propinsi.nama_propinsi, dbo.mt_perusahaan.kode_perusahaan, dbo.mt_perusahaan.flag_kontrak, dbo.mt_perusahaan.status_aktif, 
                      dbo.mt_perusahaan.keterangan_blacklist, dbo.mt_perusahaan.tgl_pjg, dbo.mt_perusahaan.tgl_exp, dbo.mt_nasabah.nama_kelompok
FROM         dbo.mt_nasabah INNER JOIN
                      dbo.mt_perusahaan ON dbo.mt_nasabah.kode_kelompok = dbo.mt_perusahaan.kode_kelompok LEFT OUTER JOIN
                      dbo.dc_propinsi INNER JOIN
                      dbo.dc_kota ON dbo.dc_propinsi.id_dc_propinsi = dbo.dc_kota.id_dc_propinsi ON dbo.mt_perusahaan.id_dc_kota = dbo.dc_kota.id_dc_kota
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [perusahaan_v]");
    }
};
