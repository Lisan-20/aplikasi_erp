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
        DB::statement("CREATE OR ALTER VIEW dbo.v_penempatan_pegawai
AS
SELECT     dbo.mt_karyawan.npp, dbo.mt_karyawan.nama_pegawai, dbo.tc_penempatan.kode_bagian_asal, mt_bagian_1.nama_bagian AS bagian_asal, 
                      dbo.tc_penempatan.kode_bagian_baru, dbo.mt_bagian.nama_bagian AS bagian_baru, dbo.tc_penempatan.tgl_mulai, dbo.tc_penempatan.st_penempatan, 
                      dbo.tc_penempatan.keterangan, dbo.tc_penempatan.id_tc_penempatan, dbo.tc_penempatan.no_sk, dbo.tc_penempatan.tgl_sk, dbo.tc_penempatan.id_jabatan
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.tc_penempatan ON dbo.mt_karyawan.npp = dbo.tc_penempatan.npp INNER JOIN
                      dbo.mt_bagian ON dbo.tc_penempatan.kode_bagian_baru = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_bagian AS mt_bagian_1 ON dbo.tc_penempatan.kode_bagian_asal = mt_bagian_1.kode_bagian
WHERE     (dbo.tc_penempatan.st_penempatan IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_penempatan_pegawai]");
    }
};
