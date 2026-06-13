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
        DB::statement("CREATE VIEW dbo.tc_sertifikasi_v
AS
SELECT     dbo.tc_sertifikat.id_tc_sertifikat, dbo.tc_sertifikat.npp, dbo.tc_sertifikat.nama_kegiatan, dbo.tc_sertifikat.tgl_kegiatan, dbo.tc_sertifikat.lembaga, dbo.tc_sertifikat.no_piagam, dbo.tc_sertifikat.input_id, 
                      dbo.tc_sertifikat.input_tgl, dbo.tc_sertifikat.status, dbo.tc_sertifikat.status_tgl, dbo.mt_karyawan.nama_pegawai, dbo.tc_sertifikat.id_int, dbo.tc_sertifikat.durasi
FROM         dbo.tc_sertifikat INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_sertifikat.npp = dbo.mt_karyawan.npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_sertifikasi_v]");
    }
};
