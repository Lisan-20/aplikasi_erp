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
        DB::statement("CREATE VIEW dbo.absen_kehadiran_outsourcing_v
AS
SELECT     dbo.mt_karyawan_outsourcing.npp, dbo.absen_masuk_outsourcing_v.USERID, dbo.absen_masuk_outsourcing_v.bln, dbo.absen_masuk_outsourcing_v.thn, 
                      dbo.absen_masuk_outsourcing_v.CHECKTIME, dbo.absen_masuk_outsourcing_v.nama_pegawai, COUNT(dbo.absen_masuk_outsourcing_v.tgl) AS jml
FROM         dbo.mt_karyawan_outsourcing LEFT OUTER JOIN
                      dbo.absen_masuk_outsourcing_v ON dbo.mt_karyawan_outsourcing.npp = dbo.absen_masuk_outsourcing_v.npp
GROUP BY dbo.mt_karyawan_outsourcing.npp, dbo.absen_masuk_outsourcing_v.USERID, dbo.absen_masuk_outsourcing_v.bln, dbo.absen_masuk_outsourcing_v.thn, 
                      dbo.absen_masuk_outsourcing_v.CHECKTIME, dbo.absen_masuk_outsourcing_v.nama_pegawai
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [absen_kehadiran_outsourcing_v]");
    }
};
