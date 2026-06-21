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
        DB::statement("CREATE OR ALTER VIEW dbo.jumlah_pasien_perina_v
AS
SELECT     bulan, tahun, COUNT(kode_tarif) AS jumlah_pasien
FROM         dbo.pasien_perina_v
GROUP BY bulan, tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_pasien_perina_v]");
    }
};
