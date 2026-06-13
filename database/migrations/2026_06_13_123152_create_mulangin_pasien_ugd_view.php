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
        DB::statement("CREATE OR ALTER VIEW dbo.mulangin_pasien_ugd
AS
SELECT     YEAR(dbo.gd_daftar_antrian_v.tgl_masuk) AS Expr1, dbo.gd_daftar_antrian_v.*, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.kode_bagian_keluar, 
                      dbo.tc_registrasi.status_registrasi, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_registrasi.kode_perusahaan AS Expr2, 
                      dbo.gd_daftar_antrian_v.status_batal AS Expr3
FROM         dbo.gd_daftar_antrian_v INNER JOIN
                      dbo.tc_registrasi ON dbo.gd_daftar_antrian_v.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
WHERE     (YEAR(dbo.gd_daftar_antrian_v.tgl_masuk) = 2013) AND (NOT (dbo.tc_registrasi.kode_perusahaan IN (93, 94, 95)))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mulangin_pasien_ugd]");
    }
};
