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
        DB::statement("CREATE VIEW dbo.update_generik
AS
SELECT     dbo.generik.nama_brg, dbo.generik.kode_gen, dbo.mt_barang.kode_generik, dbo.generik.kode_brg_lama, dbo.generik.kode_brg_baru, dbo.mt_barang.kode_brg, 
                      SUBSTRING(dbo.generik.kode_gen, 1, 4) AS kode_sub_gol, dbo.mt_barang.kode_sub_golongan
FROM         dbo.generik INNER JOIN
                      dbo.mt_barang ON dbo.generik.nama_brg = dbo.mt_barang.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_generik]");
    }
};
