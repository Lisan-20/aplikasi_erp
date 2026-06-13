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
        DB::statement("CREATE VIEW dbo.upd_mt_karyawan_v
AS
SELECT     dbo.mt_karyawan.npp, dbo.upd_data_karyawan.[PENDIDIKAN AKHIR], dbo.dc_pendidikan.id_dc_pendidikan
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.upd_data_karyawan ON dbo.mt_karyawan.nama_pegawai = dbo.upd_data_karyawan.NAMA LEFT OUTER JOIN
                      dbo.dc_pendidikan ON dbo.upd_data_karyawan.[PENDIDIKAN AKHIR] = dbo.dc_pendidikan.pendidikan
WHERE     (NOT (dbo.mt_karyawan.npp IN
                          (SELECT     npp
                            FROM          dbo.dc_riwayat_pendidikan))) AND (dbo.dc_pendidikan.id_dc_pendidikan IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_mt_karyawan_v]");
    }
};
