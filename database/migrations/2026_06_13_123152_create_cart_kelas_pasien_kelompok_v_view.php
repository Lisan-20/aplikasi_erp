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
        DB::statement("CREATE OR ALTER VIEW dbo.cart_kelas_pasien_kelompok_v
AS
SELECT     COUNT(dbo.ri_cari_pasien_v.no_registrasi) AS jml, dbo.ri_cari_pasien_v.kode_kelompok, dbo.mt_nasabah.nama_kelompok
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.mt_nasabah ON dbo.ri_cari_pasien_v.kode_kelompok = dbo.mt_nasabah.kode_kelompok
GROUP BY dbo.ri_cari_pasien_v.kode_kelompok, dbo.mt_nasabah.nama_kelompok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cart_kelas_pasien_kelompok_v]");
    }
};
