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
        DB::statement("CREATE OR ALTER VIEW dbo.laba_tx_harian_lev_3
AS
SELECT     dbo.laba_tx_harian_lev_4.acc_no, dbo.laba_tx_harian_lev_4.bulan, dbo.laba_tx_harian_lev_4.tahun, dbo.mt_account.level_coa, dbo.laba_tx_harian_lev_4.tx_nominal, 
                      dbo.laba_tx_harian_lev_4.tx_tipe, dbo.laba_tx_harian_lev_4.tx_uraian, dbo.laba_tx_harian_lev_4.tx_tgl, dbo.laba_tx_harian_lev_4.no_bukti, dbo.laba_tx_harian_lev_4.kode_bagian, 
                      dbo.laba_tx_harian_lev_4.kel_jurnal, dbo.laba_tx_harian_lev_4.kode_perusahaan, dbo.laba_tx_harian_lev_4.kode_supplier, dbo.laba_tx_harian_lev_4.kode_barang, 
                      dbo.laba_tx_harian_lev_4.kode_dr, dbo.mt_account.acc_no AS referensi, mt_account_1.acc_nama, dbo.mt_account.id_biaya
FROM         dbo.mt_account INNER JOIN
                      dbo.laba_tx_harian_lev_4 ON dbo.mt_account.acc_no = dbo.laba_tx_harian_lev_4.referensi INNER JOIN
                      dbo.mt_account AS mt_account_1 ON dbo.laba_tx_harian_lev_4.acc_no = mt_account_1.acc_no
WHERE     (dbo.mt_account.level_coa = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laba_tx_harian_lev_3]");
    }
};
