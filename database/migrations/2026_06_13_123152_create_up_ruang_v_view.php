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
        DB::statement("CREATE OR ALTER VIEW dbo.up_ruang_v
AS
SELECT     dbo.mt_bagian.validasi, dbo.mt_bagian.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_ruangan.no_kamar
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_ruangan ON dbo.mt_bagian.kode_bagian = dbo.mt_ruangan.kode_bagian
WHERE     (dbo.mt_bagian.validasi = '030001') AND (dbo.mt_bagian.kode_bagian <> '031301')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [up_ruang_v]");
    }
};
