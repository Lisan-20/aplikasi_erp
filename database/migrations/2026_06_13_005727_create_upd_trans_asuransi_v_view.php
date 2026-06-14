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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_trans_asuransi_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.lain_lain, dbo.fr_tc_far_detail.jumlah_pesan, dbo.fr_tc_far_detail.harga_jual, 
                      dbo.fr_tc_far_detail.harga_r, dbo.fr_tc_far_detail.biaya_tebus, dbo.fr_tc_far_detail.jumlah_retur, dbo.tc_trans_pelayanan.bill_rs
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.tc_trans_pelayanan.kd_tr_resep = dbo.fr_tc_far_detail.kd_tr_resep
WHERE     (dbo.tc_trans_pelayanan.no_registrasi = 159998) AND (dbo.tc_trans_pelayanan.status_kredit = 1) AND (dbo.tc_trans_pelayanan.bill_rs_jatah = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_trans_asuransi_v]");
    }
};
