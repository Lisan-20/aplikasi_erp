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
        DB::statement("CREATE VIEW dbo.v_jurnal_cogs_obat_bebas
AS
SELECT     TOP (100) PERCENT dbo.tran_sed_bebas.jumlah AS jumlah_barang, dbo.tran_sed_bebas.harga_beli, dbo.jurnal_billing_obat_bebas_v.tx_tgl, dbo.jurnal_billing_obat_bebas_v.no_bukti, 
                      dbo.jurnal_billing_obat_bebas_v.kel_jurnal, dbo.jurnal_billing_obat_bebas_v.kode_tc_trans_kasir, dbo.jurnal_billing_obat_bebas_v.no_registrasi, dbo.tran_sed_bebas.no_mr, 
                      dbo.tran_sed_bebas.kode_bagian, dbo.tran_sed_bebas.kode_bagian_asal, dbo.tran_sed_bebas.kode_barang
FROM         dbo.tran_sed_bebas INNER JOIN
                      dbo.jurnal_billing_obat_bebas_v ON dbo.tran_sed_bebas.kode_tc_trans_kasir = dbo.jurnal_billing_obat_bebas_v.kode_tc_trans_kasir AND 
                      dbo.tran_sed_bebas.kode_barang COLLATE Latin1_General_CI_AS = dbo.jurnal_billing_obat_bebas_v.kode_barang
WHERE     (dbo.tran_sed_bebas.kode IN (11, 9)) AND (dbo.tran_sed_bebas.harga_beli > 0) AND (dbo.tran_sed_bebas.kode_barang <> '') AND (dbo.jurnal_billing_obat_bebas_v.kel_jurnal = '9')
ORDER BY dbo.tran_sed_bebas.tgl_jam DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jurnal_cogs_obat_bebas]");
    }
};
