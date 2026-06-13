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
        DB::statement("CREATE VIEW dbo.mutasi_obat_igd_thn_v
AS
SELECT     kode_brg, nama_brg, SUM(masuk) AS masuk, SUM(keluar) AS keluar, kode_bagian, thn
FROM         dbo.mutasi_obat_igd_bln_v
GROUP BY kode_brg, nama_brg, kode_bagian, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mutasi_obat_igd_thn_v]");
    }
};
