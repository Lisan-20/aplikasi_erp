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
        DB::statement("CREATE VIEW dbo.update_harga_obat_trans_v
AS
SELECT     TOP (200) dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.lain_lain, dbo.tc_trans_pelayanan.jumlah, 
                      dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.kode_trans_far, dbo.fr_tc_far_detail.harga_jual, 
                      dbo.fr_tc_far_detail.harga_r, dbo.fr_tc_far_detail.biaya_tebus
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.tc_trans_pelayanan.kd_tr_resep = dbo.fr_tc_far_detail.kd_tr_resep
WHERE     (dbo.tc_trans_pelayanan.no_registrasi = 140008) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 11) AND (dbo.tc_trans_pelayanan.bill_rs = 0) AND 
                      (dbo.tc_trans_pelayanan.bill_rs_jatah = 0)
ORDER BY dbo.tc_trans_pelayanan.kd_tr_resep
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_harga_obat_trans_v]");
    }
};
