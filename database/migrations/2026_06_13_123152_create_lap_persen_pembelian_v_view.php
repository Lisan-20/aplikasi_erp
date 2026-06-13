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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_persen_pembelian_v
AS
SELECT     TOP (100) PERCENT dbo.penerimaan_brg_farmasi_v.bln, dbo.penerimaan_brg_farmasi_v.thn, dbo.penerimaan_brg_farmasi_v.nama_brg, dbo.penerimaan_brg_farmasi_v.jumlah_kirim, 
                      dbo.pengeluaran_obat_v.masuk, dbo.pengeluaran_obat_v.keluar, dbo.pengeluaran_obat_v.kode_brg, dbo.penerimaan_brg_farmasi_v.masuk_gdg AS penerimaan, 
                      dbo.penerimaan_brg_farmasi_v.flag_is
FROM         dbo.pengeluaran_obat_v RIGHT OUTER JOIN
                      dbo.penerimaan_brg_farmasi_v ON dbo.pengeluaran_obat_v.bln = dbo.penerimaan_brg_farmasi_v.bln AND dbo.pengeluaran_obat_v.thn = dbo.penerimaan_brg_farmasi_v.thn AND 
                      dbo.pengeluaran_obat_v.kode_brg = dbo.penerimaan_brg_farmasi_v.kode_brg
ORDER BY dbo.penerimaan_brg_farmasi_v.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_persen_pembelian_v]");
    }
};
