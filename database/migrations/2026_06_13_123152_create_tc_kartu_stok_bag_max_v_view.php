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
        DB::statement("CREATE VIEW dbo.tc_kartu_stok_bag_max_v
AS
SELECT     TOP (100) PERCENT dbo.tc_kartu_stok.id_kartu, dbo.tc_kartu_stok.kode_brg, dbo.tc_kartu_stok.kode_bagian, YEAR(dbo.tc_kartu_stok.tgl_input) AS thn, MONTH(dbo.tc_kartu_stok.tgl_input) AS bln, 
                      dbo.tc_kartu_stok.stok_akhir, dbo.mt_rekap_stok_temp.id
FROM         dbo.tc_kartu_stok INNER JOIN
                      dbo.mt_rekap_stok_temp ON dbo.tc_kartu_stok.kode_brg = dbo.mt_rekap_stok_temp.kode_brg AND dbo.tc_kartu_stok.kode_bagian = dbo.mt_rekap_stok_temp.kode_bagian
WHERE     (YEAR(dbo.tc_kartu_stok.tgl_input) >= 2023)
ORDER BY dbo.tc_kartu_stok.id_kartu DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kartu_stok_bag_max_v]");
    }
};
