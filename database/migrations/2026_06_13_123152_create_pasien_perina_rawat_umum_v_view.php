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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_perina_rawat_umum_v
AS
SELECT DISTINCT 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_tarif, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bulan, YEAR(dbo.tc_trans_kasir.tgl_jam) AS tahun, 
                      dbo.mt_master_pasien.nama_kel_pasien, dbo.mt_master_pasien.nama_ayah, dbo.mt_master_pasien.mr_ibu, 8 AS kode_klasifikasi, 
                      dbo.tc_trans_kasir.nama_pasien
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_kasir.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.tc_trans_pelayanan.kode_bagian = '030601') AND (YEAR(dbo.tc_trans_kasir.tgl_jam) >= 2014) AND (dbo.mt_master_pasien.mr_ibu IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_perina_rawat_umum_v]");
    }
};
