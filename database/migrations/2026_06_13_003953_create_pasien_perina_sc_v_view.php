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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_perina_sc_v
AS
SELECT     no_mr, bulan, tahun, nama_tarif, 7 AS kode_klasifikasi, nama_pasien
FROM         dbo.pasien_perina_v
WHERE     (nama_tarif LIKE '%sectio%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_perina_sc_v]");
    }
};
