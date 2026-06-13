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
        DB::statement("CREATE VIEW dbo.cart_kelas_pasien_v
AS
SELECT     COUNT(dbo.ri_cari_pasien_v.no_registrasi) AS jml, dbo.ri_cari_pasien_v.kelas_pas, dbo.mt_klas.nama_klas
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.mt_klas ON dbo.ri_cari_pasien_v.kelas_pas = dbo.mt_klas.kode_klas
GROUP BY dbo.ri_cari_pasien_v.kelas_pas, dbo.mt_klas.nama_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cart_kelas_pasien_v]");
    }
};
