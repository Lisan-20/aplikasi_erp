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
        DB::statement("CREATE VIEW dbo.obat_karyawan_v
AS
SELECT     dbo.fr_tc_far.kode_trans_far, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.fr_tc_far_detail.status_retur, dbo.fr_tc_far_detail.jumlah_pesan, dbo.fr_tc_far_detail.jumlah_tebus, dbo.fr_tc_far_detail.sisa, 
                      dbo.fr_tc_far_detail.jumlah_retur, dbo.fr_tc_far_detail.harga_beli, dbo.fr_tc_far_detail.harga_jual, dbo.fr_tc_far_detail.biaya_tebus, 
                      dbo.tc_trans_pelayanan.obat_cover_persh, dbo.tc_trans_pelayanan.diskon_rs_jatah, dbo.fr_tc_far_detail.diskon, dbo.tc_trans_kasir.potongan, 
                      dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.nk_perusahaan, dbo.fr_tc_far_detail.harga_r, dbo.fr_tc_far.no_resep, dbo.fr_tc_far.kode_profit, 
                      dbo.fr_tc_far_detail.kode_brg, dbo.fr_tc_far_detail.bill_rs_jatah, dbo.fr_tc_far_detail.bill_dr1_jatah, dbo.fr_tc_far_detail.harga_r_retur
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.fr_tc_far ON dbo.tc_trans_pelayanan.kode_trans_far = dbo.fr_tc_far.kode_trans_far INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.tc_trans_pelayanan.kd_tr_resep = dbo.fr_tc_far_detail.kd_tr_resep
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 11) AND (dbo.tc_trans_pelayanan.kode_perusahaan IN (703, 447, 882, 428, 839, 840, 39, 838, 902, 593, 596, 
                      501, 594, 95, 595, 96, 333, 448))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_karyawan_v]");
    }
};
