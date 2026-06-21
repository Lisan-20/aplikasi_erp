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
        DB::statement("CREATE OR ALTER VIEW dbo.absen_masuk_outsourcing_v
AS
SELECT     TOP (100) PERCENT dbo.CHECKINOUT_OK.USERID, dbo.CHECKINOUT_OK.CHECKTYPE, DAY(dbo.CHECKINOUT_OK.CHECKTIME) AS tgl, MONTH(dbo.CHECKINOUT_OK.CHECKTIME) AS bln, 
                      YEAR(dbo.CHECKINOUT_OK.CHECKTIME) AS thn, dbo.CHECKINOUT_OK.CHECKTYPE AS jml_absen, dbo.CHECKINOUT_OK.CHECKTIME, dbo.CHECKINOUT_OK.VERIFYCODE, 
                      dbo.CHECKINOUT_OK.SENSORID, dbo.CHECKINOUT_OK.Memoinfo, dbo.CHECKINOUT_OK.WorkCode, dbo.CHECKINOUT_OK.sn, dbo.CHECKINOUT_OK.id_check, dbo.CHECKINOUT_OK.npp, 
                      dbo.CHECKINOUT_OK.UserExtFmt, { fn HOUR(dbo.CHECKINOUT_OK.CHECKTIME) } AS jam, { fn MINUTE(dbo.CHECKINOUT_OK.CHECKTIME) } AS menit, 
                      dbo.mt_karyawan_outsourcing.nama_pegawai
FROM         dbo.CHECKINOUT_OK INNER JOIN
                      dbo.mt_karyawan_outsourcing ON dbo.CHECKINOUT_OK.npp = dbo.mt_karyawan_outsourcing.npp
WHERE     (NOT (dbo.CHECKINOUT_OK.CHECKTYPE LIKE 'O'))
ORDER BY tgl, dbo.CHECKINOUT_OK.USERID
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [absen_masuk_outsourcing_v]");
    }
};
