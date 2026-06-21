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
        DB::statement("CREATE OR ALTER VIEW dbo.updt_kamar_v
AS
SELECT        dbo.mt_bagian.nama_bagian, dbo.mt_ruangan.kode_bagian, dbo.mt_ruangan.no_kamar, dbo.mt_ruangan.no_bed
FROM            dbo.mt_bagian INNER JOIN
                         dbo.mt_ruangan ON dbo.mt_bagian.kode_bagian = dbo.mt_ruangan.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [updt_kamar_v]");
    }
};
