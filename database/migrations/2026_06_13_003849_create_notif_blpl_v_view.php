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
        DB::statement("CREATE OR ALTER VIEW dbo.notif_blpl_v
AS
SELECT     COUNT(dbo.ri_cari_pasien_v.no_registrasi) AS Expr1, dbo.ri_cari_pasien_v.bag_pas, dbo.mt_bagian.nama_bagian
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.mt_bagian ON dbo.ri_cari_pasien_v.bag_pas = dbo.mt_bagian.kode_bagian
WHERE     (dbo.ri_cari_pasien_v.tgl_blpl IS NOT NULL) AND (dbo.ri_cari_pasien_v.status_blpl = 1)
GROUP BY dbo.ri_cari_pasien_v.bag_pas, dbo.mt_bagian.nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [notif_blpl_v]");
    }
};
