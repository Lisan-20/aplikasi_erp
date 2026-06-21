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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_perusahaan_tagih_v
AS
SELECT     dbo.mt_perusahaan.kode_perusahaan, mt_perusahaan_1.nama_perusahaan, dbo.mt_perusahaan.kode_perusahaan_tagih
FROM         dbo.mt_perusahaan INNER JOIN
                      dbo.mt_perusahaan AS mt_perusahaan_1 ON dbo.mt_perusahaan.kode_perusahaan_tagih = mt_perusahaan_1.kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_perusahaan_tagih_v]");
    }
};
