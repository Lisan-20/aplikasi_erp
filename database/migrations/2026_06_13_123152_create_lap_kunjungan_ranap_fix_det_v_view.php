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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_ranap_fix_det_v
AS
SELECT     dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_kunjungan.kode_bagian_tujuan, 
                      dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_batal
FROM         dbo.lap_kunjungan_ranap_fix_v INNER JOIN
                      dbo.tc_kunjungan ON dbo.lap_kunjungan_ranap_fix_v.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_ranap_fix_det_v]");
    }
};
