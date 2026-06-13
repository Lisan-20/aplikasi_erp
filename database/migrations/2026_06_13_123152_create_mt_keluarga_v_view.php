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
        DB::statement("CREATE VIEW dbo.mt_keluarga_v
AS
SELECT     dbo.mt_keluarga.no_kk, dbo.mt_keluarga.nama_keluarga, dbo.mt_keluarga.tmp_lahir, dbo.mt_keluarga.tgl_lahir, dbo.dc_hub_keluarga.hub_keluarga, 
                      dbo.dc_hub_keluarga.id_dc_hub, dbo.mt_keluarga.tlp, dbo.dc_sex.sex, dbo.dc_pekerjaan.pekerjaan, dbo.dc_pendidikan.pendidikan, dbo.mt_keluarga.npp, 
                      dbo.mt_keluarga.no_mr, dbo.mt_keluarga.status_ditanggung, dbo.mt_keluarga.kode_dokter
FROM         dbo.mt_keluarga LEFT OUTER JOIN
                      dbo.dc_pendidikan ON dbo.mt_keluarga.id_dc_tingkat_pnddkan = dbo.dc_pendidikan.id_dc_pendidikan LEFT OUTER JOIN
                      dbo.dc_sex ON dbo.mt_keluarga.id_dc_sex = dbo.dc_sex.id_dc_sex LEFT OUTER JOIN
                      dbo.dc_pekerjaan ON dbo.mt_keluarga.id_dc_pekerjaan = dbo.dc_pekerjaan.id_dc_pekerjaan LEFT OUTER JOIN
                      dbo.dc_hub_keluarga ON dbo.mt_keluarga.id_hub = dbo.dc_hub_keluarga.id_dc_hub
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_keluarga_v]");
    }
};
