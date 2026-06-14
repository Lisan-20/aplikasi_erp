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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_masih_rawat_obat_v
AS
SELECT     TOP (100) PERCENT a.no_mr, a.no_registrasi, a.nama_pasien, a.bag_pas, a.kode_ri, a.tgl_masuk, b.nama_bagian, b.kode_depo_bag
FROM         dbo.ri_cari_pasien2_v AS a INNER JOIN
                      dbo.mt_bagian AS b ON a.bag_pas = b.kode_bagian
WHERE     (a.no_registrasi > 0)
GROUP BY a.no_mr, a.no_registrasi, a.nama_pasien, a.bag_pas, a.kode_ri, a.tgl_masuk, b.nama_bagian, b.kode_depo_bag
ORDER BY a.tgl_masuk DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_masih_rawat_obat_v]");
    }
};
