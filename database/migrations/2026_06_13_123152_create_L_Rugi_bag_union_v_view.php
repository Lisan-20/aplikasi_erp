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
        DB::statement("CREATE OR ALTER VIEW dbo.L_Rugi_bag_union_v
AS
SELECT     acc_no,debet,kredit,bulan,tahun,referensi,kode_bagian
FROM         L_Rugi_bag_5_d_v
union
SELECT     acc_no,debet,kredit,bulan,tahun,referensi,kode_bagian
FROM         L_Rugi_bag_5_k_v
union
SELECT     acc_no,debet,kredit,bulan,tahun,referensi,kode_bagian
FROM         L_Rugi_bag_3_d_v
union
SELECT     acc_no,debet,kredit,bulan,tahun,referensi,kode_bagian
FROM         L_Rugi_bag_3_k_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [L_Rugi_bag_union_v]");
    }
};
