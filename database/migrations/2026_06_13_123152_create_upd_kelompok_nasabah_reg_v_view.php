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
        DB::statement("CREATE VIEW dbo.upd_kelompok_nasabah_reg_v
AS
SELECT     dbo.tc_registrasi.kode_perusahaan AS kode_perusahaan_reg, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.no_mr, 
                      dbo.tc_trans_kasir.kode_perusahaan
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.tc_registrasi.kode_kelompok IN (5, 3)) AND (dbo.tc_registrasi.kode_perusahaan > 0) AND (dbo.tc_trans_kasir.kode_perusahaan <= 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kelompok_nasabah_reg_v]");
    }
};
