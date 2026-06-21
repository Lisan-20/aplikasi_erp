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
        DB::statement("CREATE OR ALTER VIEW dbo.monitoring_pengadaan_bebas_v
AS
SELECT     kode_pengadaan, induk_bebas, tempat_pembelian
FROM         dbo.fr_pengadaan_bebas
GROUP BY kode_pengadaan, induk_bebas, tempat_pembelian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [monitoring_pengadaan_bebas_v]");
    }
};
