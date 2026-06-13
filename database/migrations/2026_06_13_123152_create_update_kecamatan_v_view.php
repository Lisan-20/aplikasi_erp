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
        DB::statement("CREATE VIEW dbo.update_kecamatan_v
AS
SELECT     dbo.master_pasien_srv_v.no_mr, dbo.master_pasien_srv_v.NOPASIEN, dbo.master_pasien_srv_v.kota, dbo.master_pasien_srv_v.kelurahan, dbo.master_pasien_srv_v.kecamatan, 
                      dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.id_dc_kecamatan
FROM         dbo.master_pasien_srv_v INNER JOIN
                      dbo.mt_master_pasien ON dbo.master_pasien_srv_v.no_mr COLLATE SQL_Latin1_General_CP1_CI_AS = dbo.mt_master_pasien.no_mr
WHERE     (dbo.master_pasien_srv_v.kecamatan = 'BEKASI BARAT')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kecamatan_v]");
    }
};
