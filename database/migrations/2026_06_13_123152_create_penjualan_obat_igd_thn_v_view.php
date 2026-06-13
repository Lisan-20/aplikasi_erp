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
        DB::statement("CREATE VIEW dbo.penjualan_obat_igd_thn_v
AS
SELECT     kode_brg, nama_brg, SUM(jumlah) AS jumlah, thn, SUM(bill_rs) AS bill_rs, satuan_kecil
FROM         dbo.penjualan_obat_igd_bln_v
GROUP BY kode_brg, nama_brg, thn, satuan_kecil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penjualan_obat_igd_thn_v]");
    }
};
