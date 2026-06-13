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
        DB::statement("CREATE OR ALTER VIEW dbo.surat_izin_v
AS
SELECT     dbo.mt_surat_izin.keterangan, dbo.mt_karyawan.nama_pegawai, dbo.tc_surat_izin.id_tc_surat_izin, dbo.tc_surat_izin.id_mt_surat_izin, dbo.tc_surat_izin.no_surat, 
                      dbo.tc_surat_izin.tgl_berlaku, dbo.tc_surat_izin.tgl_berakhir, dbo.tc_surat_izin.kode_dokter, dbo.tc_surat_izin.npp
FROM         dbo.mt_surat_izin RIGHT OUTER JOIN
                      dbo.tc_surat_izin ON dbo.mt_surat_izin.id_mt_surat_izin = dbo.tc_surat_izin.id_mt_surat_izin LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_surat_izin.kode_dokter = dbo.mt_karyawan.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [surat_izin_v]");
    }
};
