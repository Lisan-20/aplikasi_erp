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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_harga_beli_racikan_v
AS
SELECT     TOP (100) PERCENT dbo.tran_sed.harga_beli, dbo.tc_trans_pelayanan.harga_beli AS harga_beli_trans, dbo.tran_sed.kd_tr_resep, 
                      dbo.tc_trans_pelayanan.kd_tr_resep AS kd_tr_resep_trans, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tran_sed.tx_nominal, dbo.tran_sed.jumlah
FROM         dbo.tran_sed INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tran_sed.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
WHERE     (dbo.tran_sed.jumlah > 0) AND (dbo.tran_sed.kode <> 2) AND (dbo.tran_sed.kode_barang = 'D38A0186')
ORDER BY dbo.tran_sed.no_registrasi DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_beli_racikan_v]");
    }
};
