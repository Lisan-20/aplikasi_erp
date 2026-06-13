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
        DB::statement("CREATE VIEW dbo.update_nik_medcare_v
AS
SELECT     dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, 
                      dbo.mt_master_pasien.nama_kel_pasien, dbo.mt_master_pasien.nik, dbo.tc_registrasi.no_jaminan, dbo.tc_registrasi.kode_perusahaan
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_registrasi ON dbo.mt_master_pasien.no_mr = dbo.tc_registrasi.no_mr INNER JOIN
                      dbo.tc_trans_kasir ON dbo.mt_master_pasien.no_mr = dbo.tc_trans_kasir.no_mr AND 
                      dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.tc_trans_kasir.seri_kuitansi = 'aj') AND (dbo.tc_registrasi.kode_perusahaan = 413 OR
                      dbo.tc_registrasi.kode_perusahaan = 188) AND (dbo.mt_master_pasien.nama_pasien LIKE 'haereni%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_nik_medcare_v]");
    }
};
