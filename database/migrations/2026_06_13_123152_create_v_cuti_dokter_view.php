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
        DB::statement("CREATE VIEW dbo.v_cuti_dokter
AS
SELECT     dbo.tc_cuti_dokter.kode_dokter, dbo.tc_cuti_dokter.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.status, dbo.tc_cuti_dokter.range_hari, 
                      dbo.tc_cuti_dokter.id_cuti_dokter, dbo.tc_cuti_dokter.tgl_mulai_cuti, dbo.tc_cuti_dokter.tgl_akhir_cuti, dbo.tc_cuti_dokter.tgl_input, dbo.tc_cuti_dokter.keterangan
FROM         dbo.tc_cuti_dokter INNER JOIN
                      dbo.mt_bagian ON dbo.tc_cuti_dokter.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_cuti_dokter.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.mt_karyawan.status = '0') OR
                      (dbo.mt_karyawan.status IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cuti_dokter]");
    }
};
