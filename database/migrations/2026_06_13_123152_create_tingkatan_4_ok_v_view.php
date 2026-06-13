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
        DB::statement("CREATE VIEW dbo.tingkatan_4_ok_v
AS
SELECT     kode_tarif, nama_tarif, tingkatan, kode_bagian, referensi
FROM         dbo.mt_master_tarif
WHERE     (tingkatan = 4) AND (kode_bagian = '030901')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tingkatan_4_ok_v]");
    }
};
