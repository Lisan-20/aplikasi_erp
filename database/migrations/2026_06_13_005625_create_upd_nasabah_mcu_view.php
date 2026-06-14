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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_nasabah_mcu
AS
SELECT     dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.tc_trans_pelayanan.kode_kelompok AS kode_kelompok2, 
                      dbo.tc_trans_pelayanan.kode_perusahaan AS kode_perusahaan2, dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.tgl_jam_masuk, 
                      DAY(dbo.tc_registrasi.tgl_jam_masuk) AS Expr3, MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS Expr4
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
WHERE     (dbo.tc_registrasi.kode_bagian_masuk = '011801') AND (DAY(dbo.tc_registrasi.tgl_jam_masuk) = 03) AND (MONTH(dbo.tc_registrasi.tgl_jam_masuk) = 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_nasabah_mcu]");
    }
};
