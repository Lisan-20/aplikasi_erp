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
        DB::statement("CREATE VIEW dbo.rg_inforuang_v
AS
SELECT     dbo.mt_bagian.nama_bagian, dbo.mt_klas.nama_klas, dbo.mt_ruangan.no_kamar, dbo.mt_ruangan.no_bed, dbo.mt_ruangan.status, dbo.mt_bagian.validasi, dbo.mt_ruangan.kode_ruangan, 
                      dbo.mt_bagian.kode_bagian, dbo.mt_klas.kode_klas, dbo.mt_ruangan.flag_aktif
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_ruangan ON dbo.mt_bagian.kode_bagian = dbo.mt_ruangan.kode_bagian INNER JOIN
                      dbo.mt_klas ON dbo.mt_ruangan.kode_klas = dbo.mt_klas.kode_klas
WHERE     (dbo.mt_bagian.validasi = '030001') AND (dbo.mt_ruangan.flag_aktif IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rg_inforuang_v]");
    }
};
