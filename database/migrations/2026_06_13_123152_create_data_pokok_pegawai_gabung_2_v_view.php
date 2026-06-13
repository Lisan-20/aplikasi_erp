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
        DB::statement("CREATE VIEW dbo.data_pokok_pegawai_gabung_2_v
AS
SELECT     TOP (100) PERCENT npp, nama_pegawai, kode_bagian, id_status
FROM         dbo.data_pokok_pegawai_gabung_v
WHERE     (npp <> '')
ORDER BY npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_pokok_pegawai_gabung_2_v]");
    }
};
