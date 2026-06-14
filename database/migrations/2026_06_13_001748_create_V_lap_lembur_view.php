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
        DB::statement("CREATE OR ALTER VIEW dbo.V_lap_lembur
AS
SELECT     dbo.mt_karyawan.npp, dbo.mt_karyawan.nama_pegawai, SUM(dbo.tc_lembur.jumlah_uang_makan) AS jumlah_uang_makan, SUM(dbo.tc_lembur.jumlah_uang_lembur) AS jumlah_uang_lembur, 
                      SUM(dbo.tc_lembur.jumlah_jam_lembur) AS jumlah_jam_lembur, MONTH(dbo.tc_lembur.tgl_lembur) AS bln, YEAR(dbo.tc_lembur.tgl_lembur) AS thn, dbo.tc_lembur.flag_ver
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.tc_lembur ON dbo.mt_karyawan.npp = dbo.tc_lembur.npp
GROUP BY dbo.mt_karyawan.npp, dbo.mt_karyawan.nama_pegawai, MONTH(dbo.tc_lembur.tgl_lembur), YEAR(dbo.tc_lembur.tgl_lembur), dbo.tc_lembur.flag_ver
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [V_lap_lembur]");
    }
};
