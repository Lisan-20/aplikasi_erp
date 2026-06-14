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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_bedah_lev3
AS
SELECT     kode_bagian, tingkatan, nama_tarif, referensi, kode_tarif AS kode_tarif_lev3
FROM         dbo.mt_master_tarif
WHERE     (kode_bagian = '030901') AND (tingkatan = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_bedah_lev3]");
    }
};
