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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_kredensial_v
AS
SELECT     dbo.tc_pemeriksaan_kredensial.id, dbo.tc_pemeriksaan_kredensial.id_kred, dbo.tc_pemeriksaan_kredensial.kd_periksa, dbo.tc_pemeriksaan_kredensial.hasil, 
                      dbo.tc_pemeriksaan_kredensial.id_periksa, dbo.tc_kredensialing.id_pk, dbo.tc_kredensialing.id_kep, dbo.tc_kredensialing.tgl_isi_mandiri, dbo.tc_kredensialing.id_user_mandiri, 
                      dbo.mt_kewenangan_keperawatan.nm_kewenangan, dbo.tc_pemeriksaan_kredensial.npp, dbo.mt_kewenangan_keperawatan.kd_type, dbo.tc_pemeriksaan_kredensial.hasil_tim, 
                      dbo.tc_pemeriksaan_kredensial.hasil_rekomendasi, dbo.mt_kewenangan_keperawatan.nomor, dbo.mt_kewenangan_keperawatan.kd_lev
FROM         dbo.tc_pemeriksaan_kredensial INNER JOIN
                      dbo.tc_kredensialing ON dbo.tc_pemeriksaan_kredensial.id_kred = dbo.tc_kredensialing.id_kred INNER JOIN
                      dbo.mt_kewenangan_keperawatan ON dbo.tc_pemeriksaan_kredensial.kd_periksa = dbo.mt_kewenangan_keperawatan.kd_periksa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_kredensial_v]");
    }
};
