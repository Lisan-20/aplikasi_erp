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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_fee_dr_gunawan
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.bill_rs + dbo.tc_trans_pelayanan.bill_dr1 AS bill, dbo.tc_trans_pelayanan.jumlah, dbo.mt_master_pasien.nama_pasien, 
                      dbo.mt_klas.nama_klas, dbo.fee_dokter_rj_PT_temp.jumlah AS NOMINAL
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_klas ON dbo.tc_trans_pelayanan.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.fee_dokter_rj_PT_temp ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.fee_dokter_rj_PT_temp.kode_trans_pelayanan
WHERE     (dbo.tc_trans_pelayanan.kode_kelompok <> 3) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) = 1) AND (DAY(dbo.tc_trans_pelayanan.tgl_transaksi) >= 16) AND 
                      (dbo.tc_trans_pelayanan.nama_tindakan LIKE '%Anes%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_fee_dr_gunawan]");
    }
};
