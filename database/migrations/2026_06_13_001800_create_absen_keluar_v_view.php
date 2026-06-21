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
        DB::statement("CREATE OR ALTER VIEW dbo.absen_keluar_v
AS
SELECT     TOP (100) PERCENT dbo.CHECKINOUT_OK.USERID, dbo.CHECKINOUT_OK.CHECKTYPE, DAY(dbo.CHECKINOUT_OK.CHECKTIME) AS tgl, MONTH(dbo.CHECKINOUT_OK.CHECKTIME) AS bln, 
                      YEAR(dbo.CHECKINOUT_OK.CHECKTIME) AS thn, dbo.CHECKINOUT_OK.CHECKTYPE AS jml_absen, dbo.mt_karyawan.npp, dbo.CHECKINOUT_OK.CHECKTIME, dbo.CHECKINOUT_OK.VERIFYCODE, 
                      dbo.CHECKINOUT_OK.SENSORID, dbo.CHECKINOUT_OK.Memoinfo, dbo.CHECKINOUT_OK.WorkCode, dbo.CHECKINOUT_OK.sn, dbo.mt_karyawan.nama_pegawai, 
                      dbo.CHECKINOUT_OK.UserExtFmt, dbo.CHECKINOUT_OK.id_check
FROM         dbo.CHECKINOUT_OK LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.CHECKINOUT_OK.npp = dbo.mt_karyawan.npp
WHERE     (dbo.CHECKINOUT_OK.CHECKTYPE = 'O')
ORDER BY tgl, dbo.CHECKINOUT_OK.USERID
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [absen_keluar_v]");
    }
};
