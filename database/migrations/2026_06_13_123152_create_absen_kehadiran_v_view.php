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
        DB::statement("CREATE VIEW dbo.absen_kehadiran_v
AS
SELECT     dbo.absen_masuk_v.bln, dbo.absen_masuk_v.thn, COUNT(dbo.absen_masuk_v.tgl) AS jml, dbo.absen_masuk_v.CHECKTIME, dbo.absen_masuk_v.nama_pegawai, dbo.absen_masuk_v.USERID, 
                      dbo.mt_karyawan.npp
FROM         dbo.mt_karyawan LEFT OUTER JOIN
                      dbo.absen_masuk_v ON dbo.mt_karyawan.npp = dbo.absen_masuk_v.npp
GROUP BY dbo.absen_masuk_v.bln, dbo.absen_masuk_v.thn, dbo.absen_masuk_v.nama_pegawai, dbo.absen_masuk_v.USERID, dbo.mt_karyawan.npp, dbo.absen_masuk_v.CHECKTIME
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [absen_kehadiran_v]");
    }
};
