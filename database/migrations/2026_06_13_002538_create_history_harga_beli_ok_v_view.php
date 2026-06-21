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
        DB::statement("CREATE OR ALTER VIEW dbo.history_harga_beli_ok_v
AS
SELECT     kode_brg, nama_brg, flag_medis, kode_bagian
FROM         dbo.history_beli_obat_v
GROUP BY kode_brg, nama_brg, flag_medis, kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [history_harga_beli_ok_v]");
    }
};
