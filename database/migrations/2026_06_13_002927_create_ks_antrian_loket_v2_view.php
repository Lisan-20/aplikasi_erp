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
        DB::statement("CREATE OR ALTER VIEW dbo.ks_antrian_loket_v2
AS
SELECT     TOP (100) PERCENT b.nama_pasien, c.nama_bagian, a.kode_trans_pelayanan, a.kode_tc_trans_kasir, a.no_kunjungan, a.no_registrasi, a.no_mr, a.nama_pasien_layan, a.kode_kelompok, 
                      a.kode_perusahaan, a.tgl_transaksi, a.jenis_tindakan, a.nama_tindakan, a.bill_rs, a.bill_dr1, a.bill_dr2, a.bill_rs_askes, a.bill_dr1_askes, a.bill_dr2_askes, a.bill_rs_jatah, a.bill_dr1_jatah, 
                      a.bill_dr2_jatah, a.lain_lain, a.kode_dokter1, a.kode_dokter2, a.jumlah, a.kode_barang, a.kode_master_tarif_detail, a.kode_master_tarif_detail_jatah, a.kd_tr_resep, a.kode_trans_far, a.kode_tarif, 
                      a.kode_bagian, a.kode_bagian_asal, a.kode_klas, a.no_kamar, a.no_bed, a.kode_penunjang, a.kode_profit, a.status_selesai, a.status_nk, a.status_kredit
FROM         dbo.tc_trans_pelayanan AS a LEFT OUTER JOIN
                      dbo.mt_master_pasien AS b ON a.no_mr = b.no_mr LEFT OUTER JOIN
                      dbo.mt_bagian AS c ON a.kode_bagian = c.kode_bagian
WHERE     (a.status_selesai <> 2)
ORDER BY a.kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ks_antrian_loket_v2]");
    }
};
