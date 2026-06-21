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
        DB::statement("CREATE OR ALTER VIEW dbo.update_bukti_v
AS
SELECT     dbo.tc_bayar_tagih.id_tc_bayar_tagih, dbo.tc_bayar_tagih.id_tc_tagih, dbo.tc_bayar_tagih.no_kuitansi_bayar, dbo.tc_bayar_tagih.tgl_bayar, 
                      dbo.tc_bayar_tagih.jumlah_bayar, dbo.tc_bayar_tagih.id_dd_user, dbo.tc_bayar_tagih.tgl_input, dbo.tc_bayar_tagih.tgl_ver, 
                      dbo.tc_bayar_tagih.status_ver, dbo.tc_bayar_tagih.user_ver, dbo.tc_bayar_tagih.no_urut_kuitansi, dbo.tc_bayar_tagih.diskon, 
                      dbo.tc_bayar_tagih.tahun, dbo.tc_bayar_tagih.id_bd_tc_trans, dbo.tc_bayar_tagih.biaya_transfer, dbo.tc_bayar_tagih.pajak, 
                      dbo.tc_bayar_tagih.tagihan_tidak_dicover, SUBSTRING(dbo.tc_bayar_tagih.no_kuitansi_bayar, 0, 4) AS urutan, dbo.bd_tc_trans.no_bukti
FROM         dbo.tc_bayar_tagih INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.tc_bayar_tagih.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans INNER JOIN
                      dbo.bd_tc_trans ON dbo.tc_bayar_tagih.id_bd_tc_trans = dbo.bd_tc_trans.id_bd_tc_trans
WHERE     (dbo.tc_bayar_tagih.id_bd_tc_trans IN (848, 855, 858, 859, 863, 864, 865, 866))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bukti_v]");
    }
};
