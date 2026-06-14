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
        DB::statement("CREATE OR ALTER VIEW dbo.View_7
AS
SELECT     TOP (100) PERCENT kode_brg, tgl, bln, thn, petugas, kode_bagian, nama_brg, jumlah, harga, keterangan
FROM         dbo.gud_pemakaian_bhp_v
WHERE     (kode_bagian = '500007') AND (bln = '3') AND (thn = '2018') AND (keterangan LIKE '%BHP%')
ORDER BY tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [View_7]");
    }
};
