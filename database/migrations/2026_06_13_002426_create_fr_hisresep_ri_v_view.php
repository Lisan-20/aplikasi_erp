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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_hisresep_ri_v
AS
SELECT     dbo.fr_hisrajal_v.no_registrasi, dbo.fr_hisrajal_v.no_mr, dbo.fr_hisrajal_v.kode_profit, dbo.mt_bagian.nama_bagian, dbo.mt_nasabah.nama_kelompok, dbo.fr_pasienri_v.no_kunjungan, 
                      dbo.fr_pasienri_v.kode_ri, dbo.fr_pasienri_v.nama_pasien, dbo.fr_pasienri_v.kode_ruangan, dbo.fr_pasienri_v.bag_pas, dbo.fr_pasienri_v.kelas_pas, dbo.fr_pasienri_v.tgl_masuk, 
                      dbo.fr_pasienri_v.kode_kelompok, dbo.fr_pasienri_v.jen_kelamin, dbo.fr_pasienri_v.tgl_keluar, dbo.fr_pasienri_v.status_pulang
FROM         dbo.fr_pasienri_v INNER JOIN
                      dbo.mt_bagian ON dbo.fr_pasienri_v.bag_pas = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_nasabah ON dbo.fr_pasienri_v.kode_kelompok = dbo.mt_nasabah.kode_kelompok INNER JOIN
                      dbo.fr_hisrajal_v ON dbo.fr_pasienri_v.no_registrasi = dbo.fr_hisrajal_v.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_hisresep_ri_v]");
    }
};
