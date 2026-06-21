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
        DB::statement("CREATE OR ALTER VIEW dbo.absen_msk_shift_v
AS
SELECT     dbo.absen_masuk_v.USERID, dbo.absen_masuk_v.nama_pegawai, dbo.absen_masuk_v.jam AS jam_masuk, dbo.mt_shift_v.jam AS jam_shift, dbo.absen_masuk_v.menit, 
                      dbo.mt_shift_v.kode_shift, dbo.absen_masuk_v.st_shift
FROM         dbo.mt_shift_v RIGHT OUTER JOIN
                      dbo.absen_masuk_v ON dbo.mt_shift_v.jam = dbo.absen_masuk_v.jam
WHERE     (dbo.absen_masuk_v.st_shift = 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [absen_msk_shift_v]");
    }
};
