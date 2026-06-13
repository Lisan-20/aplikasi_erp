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
        DB::statement("CREATE VIEW dbo.tc_visite_dokter_v
AS
SELECT     dbo.tc_visite_dokter.no_urut_visit, dbo.tc_visite_dokter.tgl_jam, dbo.tc_visite_dokter.kode_shift, dbo.tc_visite_dokter.no_induk_per, dbo.tc_visite_dokter.kode_dokter, 
                      dbo.mt_karyawan.nama_pegawai AS nama_dokter, mt_karyawan_1.nama_pegawai AS nama_perawat, dbo.tc_visite_dokter.kode_bagian_asal
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.tc_visite_dokter ON dbo.mt_karyawan.kode_dokter = dbo.tc_visite_dokter.kode_dokter INNER JOIN
                      dbo.mt_karyawan AS mt_karyawan_1 ON dbo.tc_visite_dokter.no_induk_per = mt_karyawan_1.no_induk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_visite_dokter_v]");
    }
};
