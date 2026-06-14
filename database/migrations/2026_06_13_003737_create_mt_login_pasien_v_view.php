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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_login_pasien_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, REPLACE(CONVERT(varchar, dbo.mt_master_pasien.tgl_lhr, 103), '/', '') AS tgl_lahir, 
                      dbo.mt_master_pasien.id_mt_master_pasien, dbo.tc_registrasi.tgl_jam_masuk
FROM         dbo.mt_master_pasien LEFT OUTER JOIN
                      dbo.tc_registrasi ON dbo.mt_master_pasien.no_mr = dbo.tc_registrasi.no_mr
WHERE     (dbo.mt_master_pasien.tgl_lhr IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_login_pasien_v]");
    }
};
