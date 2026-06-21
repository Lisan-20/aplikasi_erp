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
        DB::statement("CREATE OR ALTER VIEW dbo.bagian_asal_v
AS
SELECT     dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.no_induk, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.kode_bagian_masuk, 
                      dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_tc_trans_kasir
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
GROUP BY dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.no_induk, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.kode_bagian_masuk, 
                      dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_tc_trans_kasir
HAVING      (dbo.tc_registrasi.kode_bagian_keluar LIKE '03%') AND (dbo.tc_trans_pelayanan.kode_bagian LIKE '01%' OR
                      dbo.tc_trans_pelayanan.kode_bagian LIKE '02%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bagian_asal_v]");
    }
};
