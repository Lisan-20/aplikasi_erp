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
        DB::statement("CREATE VIEW dbo.upd_jurnal_persediaan_nm_v
AS
SELECT     dbo.tx_harian.acc_no, dbo.tx_harian.kel_jurnal, dbo.tx_harian.tx_tipe, dbo.mapping_transaksi.acc_debet, dbo.mapping_transaksi.kode_proses, dbo.tx_harian.tx_uraian
FROM         dbo.tx_harian INNER JOIN
                      dbo.mapping_transaksi ON dbo.tx_harian.kode_bagian = dbo.mapping_transaksi.kode_bagian
WHERE     (dbo.tx_harian.kel_jurnal = '23') AND (dbo.tx_harian.tx_tipe = 'D') AND (dbo.mapping_transaksi.kode_proses = 13) AND (dbo.tx_harian.tx_uraian LIKE 'Persediaan ATK%') AND 
                      (dbo.tx_harian.acc_no = 4210501)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_jurnal_persediaan_nm_v]");
    }
};
