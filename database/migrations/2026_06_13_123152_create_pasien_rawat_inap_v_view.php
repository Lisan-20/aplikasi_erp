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
        DB::statement("CREATE VIEW dbo.pasien_rawat_inap_v
AS
SELECT DISTINCT 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_registrasi.kode_bagian_keluar, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bulan, YEAR(dbo.tc_trans_kasir.tgl_jam) AS tahun, 1 AS kode_klasifikasi, 
                      dbo.tc_trans_kasir.nama_pasien
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_kasir.no_registrasi NOT IN
                          (SELECT     no_registrasi
                            FROM          dbo.pasien_ok_vk_v)) AND (dbo.tc_registrasi.kode_bagian_keluar LIKE '03%') AND (YEAR(dbo.tc_trans_kasir.tgl_jam) >= 2014)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_rawat_inap_v]");
    }
};
