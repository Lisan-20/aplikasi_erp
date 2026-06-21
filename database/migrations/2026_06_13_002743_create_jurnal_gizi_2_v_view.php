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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_gizi_2_v
AS
SELECT     dbo.tx_harian.acc_no, dbo.tx_harian.kode_bagian, dbo.tx_harian.jumlah_barang, dbo.tx_harian.tx_tgl, dbo.tx_harian.no_bukti, dbo.tx_harian.no_mr, dbo.tx_harian.no_registrasi, 
                      dbo.tx_harian.kode_tc_trans_kasir, YEAR(dbo.tx_harian.tx_tgl) AS Expr1, dbo.jurnal_gizi_1_v.kode_klas, dbo.jurnal_gizi_11_v.biaya_gizi, 
                      dbo.tx_harian.jumlah_barang * dbo.jurnal_gizi_11_v.biaya_gizi AS tx_nominal, dbo.tx_harian.no_urut, dbo.tx_harian.flag_gizi, dbo.mt_klas.nama_klas
FROM         dbo.tx_harian INNER JOIN
                      dbo.jurnal_gizi_1_v ON dbo.tx_harian.no_registrasi = dbo.jurnal_gizi_1_v.no_registrasi AND dbo.tx_harian.kode_bagian = dbo.jurnal_gizi_1_v.kode_bagian INNER JOIN
                      dbo.jurnal_gizi_11_v ON dbo.jurnal_gizi_1_v.kode_kelompok = dbo.jurnal_gizi_11_v.kode_kelompok AND dbo.jurnal_gizi_1_v.kode_klas = dbo.jurnal_gizi_11_v.kode_klas INNER JOIN
                      dbo.mt_klas ON dbo.jurnal_gizi_1_v.kode_klas = dbo.mt_klas.kode_klas
WHERE     (dbo.tx_harian.acc_no = 3110101) AND (YEAR(dbo.tx_harian.tx_tgl) >= 2023)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_gizi_2_v]");
    }
};
