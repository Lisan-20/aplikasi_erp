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
        DB::statement("CREATE VIEW dbo.dokter_bpjs_v
AS
SELECT DISTINCT dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_pelayanan.kode_dokter1, dbo.mt_karyawan.nama_pegawai
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.kode_dokter
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_pelayanan.kode_dokter1, dbo.mt_karyawan.kode_spesialisasi, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_karyawan.nama_pegawai
HAVING      (dbo.tc_registrasi.kode_kelompok IN (9, 10)) AND (NOT (dbo.mt_karyawan.kode_spesialisasi IN (1, 14))) AND (dbo.tc_trans_pelayanan.kode_bagian LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dokter_bpjs_v]");
    }
};
