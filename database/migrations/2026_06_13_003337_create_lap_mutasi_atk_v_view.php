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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_mutasi_atk_v
AS
SELECT     dbo.tc_kartu_stok_nm.kode_bagian, dbo.mt_barang_jasa.nama_brg, dbo.tc_kartu_stok_nm.pengeluaran, dbo.mt_barang_jasa.kode_kategori, dbo.mt_barang_jasa.kode_golongan, 
                      dbo.tc_kartu_stok_nm.tgl_input, dbo.tc_kartu_stok_nm.pemasukan, dbo.tc_kartu_stok_nm.jenis_transaksi, dbo.tc_kartu_stok_nm.stok_awal, dbo.tc_kartu_stok_nm.stok_akhir, 
                      dbo.tc_kartu_stok_nm.kode_brg, dbo.tc_kartu_stok_nm.id_kartu, dbo.mt_barang_jasa.satuan_kecil
FROM         dbo.tc_kartu_stok_nm INNER JOIN
                      dbo.mt_barang_jasa ON dbo.tc_kartu_stok_nm.kode_brg = dbo.mt_barang_jasa.kode_brg
WHERE     (dbo.mt_barang_jasa.kode_golongan = 'F01')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_mutasi_atk_v]");
    }
};
