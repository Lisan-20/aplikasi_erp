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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_blm_bayar_v
AS
SELECT     dbo.tc_registrasi.no_registrasi, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_bagian_masuk, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.tgl_jam_masuk
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.tc_registrasi.no_registrasi, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_bagian_masuk, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.tgl_jam_masuk, YEAR(dbo.tc_registrasi.tgl_jam_masuk)
HAVING      (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL) AND (YEAR(dbo.tc_registrasi.tgl_jam_masuk) >= 2016)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_blm_bayar_v]");
    }
};
