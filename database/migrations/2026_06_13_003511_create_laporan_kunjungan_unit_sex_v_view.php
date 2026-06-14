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
        DB::statement("CREATE OR ALTER VIEW dbo.laporan_kunjungan_unit_sex_v
AS
SELECT     dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      COUNT(dbo.tc_trans_kasir.no_registrasi) AS jml_pasien, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, dbo.mt_master_pasien.jen_kelamin
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr
GROUP BY dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_perusahaan, YEAR(dbo.tc_trans_kasir.tgl_jam), 
                      MONTH(dbo.tc_trans_kasir.tgl_jam), dbo.mt_master_pasien.jen_kelamin
HAVING      (NOT (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL)) AND (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_kunjungan_unit_sex_v]");
    }
};
