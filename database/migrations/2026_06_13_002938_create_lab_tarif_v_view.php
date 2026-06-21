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
        DB::statement("CREATE OR ALTER VIEW dbo.lab_tarif_v
AS
SELECT     kode_tarif, nama_tarif, tingkatan, kode_bagian
FROM         dbo.mt_master_tarif
WHERE     (kode_bagian = '050101') AND (tingkatan = 4 OR
                      tingkatan = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lab_tarif_v]");
    }
};
