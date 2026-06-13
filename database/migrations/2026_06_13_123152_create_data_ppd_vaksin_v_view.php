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
        DB::statement("CREATE VIEW dbo.data_ppd_vaksin_v
AS
SELECT     dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_pelayanan.no_mr, dbo.mt_master_pasien.nama_pasien, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.mt_master_pasien.almt_ttp_pasien, 
                      dbo.mt_master_pasien.tlp_almt_ttp, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.nama_ayah, dbo.mt_master_pasien.nama_ibu, 
                      dbo.tc_registrasi.umur
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_pasien.no_mr = dbo.tc_trans_pelayanan.no_mr INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.nama_tindakan LIKE '%mant%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_ppd_vaksin_v]");
    }
};
