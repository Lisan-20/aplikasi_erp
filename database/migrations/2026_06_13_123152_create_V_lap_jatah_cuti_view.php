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
        DB::statement("CREATE VIEW dbo.V_lap_jatah_cuti
AS
SELECT     dbo.mt_karyawan.nama_pegawai, dbo.tc_cuti.npp, dbo.tc_jatah_cuti.tahun, dbo.dd_jenis_cuti.jenis_cuti, SUM(dbo.tc_cuti.jumlah_hari) AS jumlah_hari, dbo.tc_jatah_cuti.jatah_cuti, 
                      SUM(dbo.tc_jatah_cuti.jatah_cuti - dbo.tc_cuti.jumlah_hari) AS sisa, dbo.tc_jatah_cuti.id_dd_jenis_cuti, MONTH(dbo.tc_cuti.tgl_pengajuan) AS bln, YEAR(dbo.tc_cuti.tgl_pengajuan) AS thn, 
                      dbo.tc_cuti.flag_ver
FROM         dbo.tc_jatah_cuti RIGHT OUTER JOIN
                      dbo.mt_karyawan INNER JOIN
                      dbo.tc_cuti ON dbo.mt_karyawan.npp = dbo.tc_cuti.npp LEFT OUTER JOIN
                      dbo.dd_jenis_cuti ON dbo.tc_cuti.id_dd_jenis_cuti = dbo.dd_jenis_cuti.id_dd_jenis_cuti ON dbo.tc_jatah_cuti.npp = dbo.tc_cuti.npp
GROUP BY dbo.mt_karyawan.nama_pegawai, dbo.tc_cuti.npp, dbo.tc_jatah_cuti.tahun, dbo.dd_jenis_cuti.jenis_cuti, dbo.tc_jatah_cuti.jatah_cuti, dbo.tc_jatah_cuti.id_dd_jenis_cuti, 
                      MONTH(dbo.tc_cuti.tgl_pengajuan), YEAR(dbo.tc_cuti.tgl_pengajuan), dbo.tc_cuti.flag_ver
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [V_lap_jatah_cuti]");
    }
};
