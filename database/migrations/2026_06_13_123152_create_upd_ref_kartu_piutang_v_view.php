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
        DB::statement("CREATE VIEW dbo.upd_ref_kartu_piutang_v
AS
SELECT     dbo.bd_tc_trans.no_bukti, dbo.tc_tagih.no_invoice_tagih, dbo.tx_harian.referensi
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.tc_bayar_tagih ON dbo.bd_tc_trans.no_bukti = dbo.tc_bayar_tagih.no_kuitansi_bayar INNER JOIN
                      dbo.tc_tagih ON dbo.tc_bayar_tagih.id_tc_tagih = dbo.tc_tagih.id_tc_tagih INNER JOIN
                      dbo.tx_harian ON dbo.bd_tc_trans.no_bukti = dbo.tx_harian.no_bukti
WHERE     (dbo.tx_harian.kel_jurnal = 4) AND (dbo.tx_harian.tx_tipe = 'K') AND (dbo.tx_harian.referensi IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_ref_kartu_piutang_v]");
    }
};
