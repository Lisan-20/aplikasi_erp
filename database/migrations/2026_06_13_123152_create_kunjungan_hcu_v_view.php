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
        DB::statement("CREATE VIEW dbo.kunjungan_hcu_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_master_pasien.nama_pasien, 
                      MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, dbo.tc_trans_pelayanan.kode_perusahaan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_master_pasien.nama_pasien, 
                      MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), YEAR(dbo.tc_trans_pelayanan.tgl_transaksi), dbo.tc_trans_pelayanan.kode_perusahaan
HAVING      (dbo.tc_trans_pelayanan.kode_bagian = '034001')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kunjungan_hcu_v]");
    }
};
