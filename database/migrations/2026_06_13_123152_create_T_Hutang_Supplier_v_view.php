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
        DB::statement("CREATE VIEW dbo.T_Hutang_Supplier_v
AS
SELECT     TOP (100) PERCENT dbo.T_hutang_k_v.acc_no, dbo.T_hutang_k_v.tx_nominal, dbo.T_hutang_k_v.no_bukti, dbo.T_hutang_k_v.referensi, dbo.T_hutang_k_v.tx_tgl, 
                      dbo.T_hutang_d_v.referensi AS ref_pemb, dbo.T_hutang_d_v.tx_nominal AS jml_pemb, dbo.T_hutang_k_v.tx_tipe, dbo.T_hutang_k_v.kode_supplier, dbo.T_hutang_k_v.kel_jurnal, 
                      dbo.T_hutang_k_v.tx_uraian, dbo.T_hutang_k_v.tgl_tempo
FROM         dbo.T_hutang_k_v LEFT OUTER JOIN
                      dbo.T_hutang_d_v ON dbo.T_hutang_k_v.referensi = dbo.T_hutang_d_v.referensi
WHERE     (dbo.T_hutang_d_v.referensi IS NULL) AND (dbo.T_hutang_k_v.acc_no = 2110101) AND (dbo.T_hutang_k_v.referensi IS NOT NULL)
ORDER BY dbo.T_hutang_k_v.tx_tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [T_Hutang_Supplier_v]");
    }
};
