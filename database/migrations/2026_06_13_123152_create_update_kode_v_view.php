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
        DB::statement("CREATE VIEW dbo.update_kode_v
AS
SELECT     dbo.tc_registrasi.kode_perusahaan, dbo.tc_trans_kasir.kode_perusahaan AS kode, dbo.tc_registrasi.kode_kelompok
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi AND 
                      dbo.tc_registrasi.kode_perusahaan <> dbo.tc_trans_kasir.kode_perusahaan
WHERE     (dbo.tc_registrasi.kode_kelompok = 9)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_v]");
    }
};
