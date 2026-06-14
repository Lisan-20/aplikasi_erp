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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_tarif_ruangan_persh_v
AS
SELECT     dbo.mt_master_tarif_ruangan.*, dbo.mt_perusahaan.kode_perusahaan
FROM         dbo.mt_perusahaan CROSS JOIN
                      dbo.mt_master_tarif_ruangan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_ruangan_persh_v]");
    }
};
