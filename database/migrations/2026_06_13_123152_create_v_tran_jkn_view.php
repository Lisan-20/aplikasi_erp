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
        DB::statement("CREATE OR ALTER VIEW dbo.v_tran_jkn
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.mt_bagian.id_jenis_layanan, dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.kode_plafon, 
                      dbo.tc_registrasi.kode_kelompok, dbo.mt_bagian.kode_bagian
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi RIGHT OUTER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.mt_bagian.id_jenis_layanan, dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.kode_plafon, 
                      dbo.tc_trans_pelayanan.status_batal, dbo.tc_registrasi.kode_kelompok, dbo.mt_bagian.kode_bagian
HAVING      (dbo.mt_bagian.id_jenis_layanan > 0) AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_registrasi.kode_kelompok IN (9, 8, 11, 12))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_tran_jkn]");
    }
};
