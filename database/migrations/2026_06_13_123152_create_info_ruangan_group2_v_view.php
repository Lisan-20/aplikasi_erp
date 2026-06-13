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
        DB::statement("CREATE VIEW dbo.info_ruangan_group2_v
AS
SELECT     nama_klas, status, kode_klas, kode_bagian, nama_bagian, COUNT(urutan) AS jumlah
FROM         dbo.info_ruangan_group_v
GROUP BY nama_klas, status, kode_klas, kode_bagian, nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [info_ruangan_group2_v]");
    }
};
