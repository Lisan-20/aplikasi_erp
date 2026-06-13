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
        DB::statement("CREATE VIEW dbo.laba_tx_harian_lev_5
AS
SELECT     dbo.tx_harian.acc_no, dbo.tx_harian.tx_nominal, MONTH(dbo.tx_harian.tx_tgl) AS bulan, YEAR(dbo.tx_harian.tx_tgl) AS tahun, dbo.tx_harian.tx_tipe, dbo.mt_account.referensi, 
                      dbo.tx_harian.tx_uraian, dbo.tx_harian.tx_tgl, dbo.tx_harian.no_bukti, dbo.tx_harian.kode_bagian, dbo.tx_harian.kel_jurnal, dbo.tx_harian.kode_perusahaan, dbo.tx_harian.kode_supplier, 
                      dbo.tx_harian.kode_barang, dbo.tx_harian.kode_dr, dbo.tx_harian.ko_wil, dbo.mt_account.acc_nama, dbo.mt_bagian.grup_rl, 
                      CASE WHEN grup_rl = 1 THEN '030001' ELSE mt_bagian.kode_bagian END AS kd_bag_unit, dbo.mt_account.id_biaya
FROM         dbo.tx_harian INNER JOIN
                      dbo.mt_account ON dbo.tx_harian.acc_no = dbo.mt_account.acc_no INNER JOIN
                      dbo.mt_bagian ON dbo.tx_harian.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (YEAR(dbo.tx_harian.tx_tgl) >= 2016)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laba_tx_harian_lev_5]");
    }
};
