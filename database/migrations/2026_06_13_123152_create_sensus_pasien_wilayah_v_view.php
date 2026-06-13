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
        DB::statement("CREATE VIEW dbo.sensus_pasien_wilayah_v
AS
SELECT     dbo.mt_master_pasien.id_dc_kecamatan, dbo.dc_kecamatan.nama_kecamatan, COUNT(dbo.tc_registrasi.no_registrasi) AS jumlah, DAY(dbo.tc_registrasi.tgl_jam_masuk) AS tgl, 
                      MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, dbo.dc_kelurahan.nama_kelurahan, dbo.dc_kelurahan.id_dc_kelurahan, 
                      dbo.mt_master_pasien.id_dc_dusun, dbo.dc_dusun.nama_dusun
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_registrasi ON dbo.mt_master_pasien.no_mr = dbo.tc_registrasi.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.dc_dusun ON dbo.mt_master_pasien.id_dc_dusun = dbo.dc_dusun.id_dc_dusun LEFT OUTER JOIN
                      dbo.dc_kelurahan ON dbo.mt_master_pasien.id_dc_kelurahan = dbo.dc_kelurahan.id_dc_kelurahan LEFT OUTER JOIN
                      dbo.dc_kecamatan ON dbo.mt_master_pasien.id_dc_kecamatan = dbo.dc_kecamatan.id_dc_kecamatan
WHERE     (dbo.tc_registrasi.tgl_jam_keluar IS NOT NULL)
GROUP BY dbo.mt_master_pasien.id_dc_kecamatan, dbo.dc_kecamatan.nama_kecamatan, DAY(dbo.tc_registrasi.tgl_jam_masuk), MONTH(dbo.tc_registrasi.tgl_jam_masuk), 
                      YEAR(dbo.tc_registrasi.tgl_jam_masuk), dbo.tc_registrasi.status_batal, dbo.dc_kelurahan.nama_kelurahan, dbo.dc_kelurahan.id_dc_kelurahan, dbo.mt_master_pasien.id_dc_dusun, 
                      dbo.dc_dusun.nama_dusun
HAVING      (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sensus_pasien_wilayah_v]");
    }
};
