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
        DB::statement("CREATE VIEW dbo.hutang_supp_k_d_v2
AS
SELECT     dbo.mt_supplier.kodesupplier AS kode_supplier, dbo.mt_supplier.namasupplier, dbo.saldo_awal_hutang.saldo_awal, dbo.hutang_supp_k_d_v.acc_no, 
                      dbo.hutang_supp_k_d_v.tx_tgl, dbo.hutang_supp_k_d_v.tx_tipe, dbo.hutang_supp_k_d_v.referensi, dbo.hutang_supp_k_d_v.tx_uraian, 
                      dbo.hutang_supp_k_d_v.tx_tgl_lunas, dbo.hutang_supp_k_d_v.tx_nominal, dbo.hutang_supp_k_d_v.tx_nominal_lunas, dbo.hutang_supp_k_d_v.no_bukti, 
                      dbo.hutang_supp_k_d_v.tx_tipe_d, dbo.hutang_supp_k_d_v.no_bukti_lunas, dbo.hutang_supp_k_d_v.tgl_tempo
FROM         dbo.saldo_awal_hutang INNER JOIN
                      dbo.mt_supplier ON dbo.saldo_awal_hutang.kodesupplier = dbo.mt_supplier.kodesupplier LEFT OUTER JOIN
                      dbo.hutang_supp_k_d_v ON dbo.mt_supplier.kodesupplier = dbo.hutang_supp_k_d_v.kode_supplier
WHERE     (dbo.mt_supplier.kodesupplier <= 10)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hutang_supp_k_d_v2]");
    }
};
