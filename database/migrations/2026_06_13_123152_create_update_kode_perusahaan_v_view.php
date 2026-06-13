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
        DB::statement("CREATE VIEW dbo.update_kode_perusahaan_v
AS
SELECT     dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_registrasi.kode_perusahaan AS kode, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.no_registrasi
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_kasir.seri_kuitansi = 'AJ') AND (dbo.tc_trans_kasir.kode_perusahaan = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_perusahaan_v]");
    }
};
