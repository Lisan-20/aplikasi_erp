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
        DB::statement("CREATE VIEW dbo.laba_tx_harian_lev_4
AS
SELECT     dbo.laba_tx_harian_lev_5.acc_no, dbo.laba_tx_harian_lev_5.bulan, dbo.laba_tx_harian_lev_5.tahun, dbo.mt_account.referensi, dbo.mt_account.level_coa, dbo.laba_tx_harian_lev_5.tx_nominal, 
                      dbo.laba_tx_harian_lev_5.tx_tipe, dbo.laba_tx_harian_lev_5.tx_uraian, dbo.laba_tx_harian_lev_5.tx_tgl, dbo.laba_tx_harian_lev_5.no_bukti, dbo.laba_tx_harian_lev_5.kode_bagian, 
                      dbo.laba_tx_harian_lev_5.kel_jurnal, dbo.laba_tx_harian_lev_5.kode_perusahaan, dbo.laba_tx_harian_lev_5.kode_supplier, dbo.laba_tx_harian_lev_5.kode_barang, 
                      dbo.laba_tx_harian_lev_5.kode_dr, dbo.mt_account.acc_nama, dbo.mt_account.sub_ledger, dbo.laba_tx_harian_lev_5.kd_bag_unit, dbo.mt_account.acc_no AS [group], 
                      dbo.laba_tx_harian_lev_5.id_biaya
FROM         dbo.mt_account INNER JOIN
                      dbo.laba_tx_harian_lev_5 ON dbo.mt_account.acc_no = dbo.laba_tx_harian_lev_5.referensi
WHERE     (dbo.mt_account.level_coa = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laba_tx_harian_lev_4]");
    }
};
