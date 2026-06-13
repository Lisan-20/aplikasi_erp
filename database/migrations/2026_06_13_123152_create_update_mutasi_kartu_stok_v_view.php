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
        DB::statement("CREATE VIEW dbo.update_mutasi_kartu_stok_v
AS
SELECT     dbo.mt_rekap_stok_temp.id, dbo.mt_rekap_stok_temp.kode_bagian, dbo.mt_rekap_stok_temp.kode_brg, dbo.mt_rekap_stok_temp.pemasukan, dbo.mt_rekap_stok_temp.pengeluaran, 
                      dbo.mt_rekap_stok_temp.bln, dbo.mt_rekap_stok_temp.thn, dbo.tc_kartu_stok_lap_v.pemasukan_up, dbo.tc_kartu_stok_lap_v.pengeluaran_up
FROM         dbo.mt_rekap_stok_temp INNER JOIN
                      dbo.tc_kartu_stok_lap_v ON dbo.mt_rekap_stok_temp.kode_bagian = dbo.tc_kartu_stok_lap_v.kode_bagian AND dbo.mt_rekap_stok_temp.kode_brg = dbo.tc_kartu_stok_lap_v.kode_brg AND 
                      dbo.mt_rekap_stok_temp.bln = dbo.tc_kartu_stok_lap_v.bln AND dbo.mt_rekap_stok_temp.thn = dbo.tc_kartu_stok_lap_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_mutasi_kartu_stok_v]");
    }
};
