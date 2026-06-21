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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_obat_ruangan_bedah_v
AS
SELECT     dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jumlah, dbo.tc_kartu_stok.kode_brg, dbo.tc_kartu_stok.stok_awal, dbo.tc_kartu_stok.pemasukan, 
                      dbo.tc_kartu_stok.pengeluaran, dbo.tc_kartu_stok.jenis_transaksi, dbo.tc_kartu_stok.kode_bagian, dbo.tc_kartu_stok.stok_akhir, dbo.tc_kartu_stok.tgl_input, 
                      dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.tc_kartu_stok INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_kartu_stok.kode_brg = dbo.tc_trans_pelayanan.kode_barang AND DAY(dbo.tc_kartu_stok.tgl_input) 
                      = DAY(dbo.tc_trans_pelayanan.tgl_transaksi) AND MONTH(dbo.tc_kartu_stok.tgl_input) = MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AND 
                      dbo.tc_kartu_stok.pengeluaran = dbo.tc_trans_pelayanan.jumlah
WHERE     (dbo.tc_trans_pelayanan.kode_bagian = '030901') AND (dbo.tc_trans_pelayanan.jenis_tindakan = 9) AND (dbo.tc_kartu_stok.jenis_transaksi = 6) AND 
                      (dbo.tc_kartu_stok.kode_bagian = '030501')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_obat_ruangan_bedah_v]");
    }
};
