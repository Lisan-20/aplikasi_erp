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
        DB::statement("CREATE VIEW dbo.anggaran_bagian_v
AS
SELECT     dbo.mapping_anggaran.kode_bagian, dbo.mt_bagian.nama_bagian
FROM         dbo.mapping_anggaran INNER JOIN
                      dbo.mt_bagian ON dbo.mapping_anggaran.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.mapping_anggaran.kode_bagian, dbo.mt_bagian.nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [anggaran_bagian_v]");
    }
};
