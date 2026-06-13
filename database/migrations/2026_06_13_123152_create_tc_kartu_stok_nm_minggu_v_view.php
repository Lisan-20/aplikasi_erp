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
        DB::statement("CREATE VIEW dbo.tc_kartu_stok_nm_minggu_v
AS
SELECT     id_kartu, tgl_input, kode_brg, CASE WHEN DATEPART(day, tgl_input) < 8 THEN '1' ELSE CASE WHEN DATEPART(day, tgl_input) < 15 THEN '2' ELSE CASE WHEN DATEPART(day, tgl_input) 
                      < 22 THEN '3' ELSE '4' END END END AS minggu, stok_awal, pemasukan, pengeluaran, stok_akhir, jenis_transaksi, kode_bagian
FROM         dbo.tc_kartu_stok_nm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kartu_stok_nm_minggu_v]");
    }
};
