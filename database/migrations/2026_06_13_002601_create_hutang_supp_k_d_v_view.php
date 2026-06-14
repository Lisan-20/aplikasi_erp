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
        DB::statement("CREATE OR ALTER VIEW dbo.hutang_supp_k_d_v
AS
SELECT     dbo.hutang_sup_k.acc_no, dbo.hutang_sup_k.tx_tgl, dbo.hutang_sup_k.tx_tipe, dbo.hutang_sup_k.referensi, dbo.hutang_sup_k.tx_uraian, 
                      dbo.hutang_sup_k.kode_supplier, dbo.hutang_sup_d.tx_tgl AS tx_tgl_lunas, dbo.hutang_sup_k.tx_nominal, dbo.hutang_sup_d.tx_nominal AS tx_nominal_lunas, 
                      dbo.hutang_sup_k.no_bukti, dbo.hutang_sup_d.tx_tipe AS tx_tipe_d, dbo.hutang_sup_d.no_bukti AS no_bukti_lunas, dbo.hutang_sup_k.tgl_tempo, 
                      dbo.mt_supplier.namasupplier
FROM         dbo.hutang_sup_k LEFT OUTER JOIN
                      dbo.mt_supplier ON dbo.hutang_sup_k.kode_supplier = dbo.mt_supplier.kodesupplier LEFT OUTER JOIN
                      dbo.hutang_sup_d ON dbo.hutang_sup_k.acc_no = dbo.hutang_sup_d.acc_no AND dbo.hutang_sup_k.kode_supplier = dbo.hutang_sup_d.kode_supplier AND 
                      dbo.hutang_sup_k.referensi = dbo.hutang_sup_d.referensi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hutang_supp_k_d_v]");
    }
};
