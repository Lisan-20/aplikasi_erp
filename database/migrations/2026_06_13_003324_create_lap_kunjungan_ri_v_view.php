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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_ri_v
AS
SELECT        dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.tgl_jam_masuk, 
                         dbo.tc_registrasi.status_batal, dbo.mt_bagian.nama_bagian, dbo.mt_bagian.id_mt_bagian
FROM            dbo.tc_registrasi INNER JOIN
                         dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                         dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian
WHERE        (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_registrasi.kode_bagian_masuk LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_ri_v]");
    }
};
