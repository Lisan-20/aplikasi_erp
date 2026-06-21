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
        DB::statement("CREATE OR ALTER VIEW dbo.v_jurnal_cogs_rj_2nd
AS
SELECT     TOP (100) PERCENT dbo.tran_sed.jumlah AS jumlah_barang, dbo.tran_sed.harga_beli, dbo.jurnal_billing_v.tx_tgl, dbo.jurnal_billing_v.no_bukti, 
                      dbo.jurnal_billing_v.kel_jurnal, dbo.jurnal_billing_v.kode_tc_trans_kasir, dbo.jurnal_billing_v.no_registrasi, dbo.tran_sed.no_mr, dbo.tran_sed.kode_bagian, 
                      dbo.tran_sed.kode_bagian_asal, dbo.tran_sed.kode_barang
FROM         dbo.tran_sed INNER JOIN
                      dbo.jurnal_billing_v ON dbo.tran_sed.kode_tc_trans_kasir = dbo.jurnal_billing_v.kode_tc_trans_kasir AND 
                      dbo.tran_sed.kode_barang COLLATE Latin1_General_CI_AS = dbo.jurnal_billing_v.kode_barang
WHERE     (dbo.tran_sed.kode IN (11, 9)) AND (dbo.tran_sed.harga_beli > 0) AND (dbo.tran_sed.kode_barang <> '') AND (dbo.jurnal_billing_v.kel_jurnal = '1')
ORDER BY dbo.tran_sed.tgl_jam DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jurnal_cogs_rj_2nd]");
    }
};
