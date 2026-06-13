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
        DB::statement("CREATE VIEW dbo.tc_sertifikat_kredesialing_detail_v
AS
SELECT     dbo.tc_sertifikat_v.nama_penyelenggaran, dbo.tc_kredensialing_sertifikat.id_kred_ser, dbo.tc_kredensialing_sertifikat.id_kred, dbo.tc_kredensialing_sertifikat.id_tc_sertifikat, 
                      dbo.tc_sertifikat_v.npp, dbo.tc_sertifikat_v.nama_kegiatan, dbo.tc_sertifikat_v.tgl_kegiatan, dbo.tc_sertifikat_v.nama_file, dbo.tc_sertifikat_v.lokasi, dbo.tc_sertifikat_v.durasi, 
                      dbo.tc_sertifikat_v.skp, dbo.tc_sertifikat_v.komp_didapat
FROM         dbo.tc_kredensialing_sertifikat INNER JOIN
                      dbo.tc_sertifikat_v ON dbo.tc_kredensialing_sertifikat.id_tc_sertifikat = dbo.tc_sertifikat_v.id_tc_sertifikat
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_sertifikat_kredesialing_detail_v]");
    }
};
