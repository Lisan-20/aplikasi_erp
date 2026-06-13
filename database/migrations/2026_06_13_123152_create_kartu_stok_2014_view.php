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
        DB::statement("CREATE OR ALTER VIEW dbo.kartu_stok_2014
AS
SELECT     id_kartu, tgl_input, kode_brg, stok_awal, pemasukan, pengeluaran, stok_akhir, jenis_transaksi, kode_bagian, keterangan, petugas, pemasukan_b, pengeluaran_b, 
                      kode_detail_penerimaan_barang, no_batch, tgl_kadaluarsa
FROM         dbo.tc_kartu_stok_lama
WHERE     (YEAR(tgl_input) = 2014) AND (no_batch IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kartu_stok_2014]");
    }
};
