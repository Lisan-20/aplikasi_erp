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
        DB::statement("CREATE OR ALTER VIEW dbo.L_Rugi_5_Unit_union_v
AS
SELECT     bulan, tahun, debet, kode_bagian, nama_bagian, referensi,tx_tipe
FROM         L_Rugi_5_D_Unit_v
UNION
SELECT     bulan, tahun, kredit, kode_bagian, nama_bagian, referensi,tx_tipe
FROM         L_Rugi_5_K_Unit_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [L_Rugi_5_Unit_union_v]");
    }
};
