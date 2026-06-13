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
        DB::statement("CREATE OR ALTER VIEW dbo.update_bayar_tagihan_v
AS
SELECT     dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.no_ref, dbo.bd_tc_trans.tgl_transaksi, dbo.tc_tagih.id_tc_tagih, dbo.tc_tagih.no_invoice_tagih, 
                      dbo.tc_bayar_tagih.no_kuitansi_bayar
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.tc_tagih ON dbo.bd_tc_trans.no_ref = dbo.tc_tagih.no_invoice_tagih INNER JOIN
                      dbo.tc_bayar_tagih ON dbo.tc_tagih.id_tc_tagih = dbo.tc_bayar_tagih.id_tc_tagih
WHERE     (dbo.bd_tc_trans.no_bukti = '18/KU/01/2014')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bayar_tagihan_v]");
    }
};
