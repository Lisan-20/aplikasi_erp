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
        DB::statement("CREATE VIEW dbo.lap_amprah_gudang_nm_sum_v
AS
SELECT     kode_bagian_minta, kode_bagian_kirim, bagian_minta, nama_brg, kode_brg, satuan, SUM(jumlah_permintaan) AS jumlah_penerimaan, MONTH(tgl_permintaan) AS bln, YEAR(tgl_permintaan) 
                      AS thn
FROM         dbo.lap_amprah_gudang_nm_v
GROUP BY kode_bagian_minta, kode_bagian_kirim, bagian_minta, nama_brg, kode_brg, satuan, MONTH(tgl_permintaan), YEAR(tgl_permintaan)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_amprah_gudang_nm_sum_v]");
    }
};
