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
        DB::statement("CREATE VIEW dbo.isi_ruangan_v
AS
SELECT     tgl_keluar, kelas_pas, kode_ruangan, bag_pas
FROM         dbo.ri_tc_rawatinap
WHERE     (tgl_keluar IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [isi_ruangan_v]");
    }
};
