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
        DB::statement("

CREATE OR ALTER VIEW dbo.jenisOperasi_v
AS
SELECT     nama_tarif, kode_bagian, tingkatan
FROM         dbo.mt_master_tarif
GROUP BY nama_tarif, kode_bagian, tingkatan
HAVING      (kode_bagian = '030901') AND (tingkatan = 4)


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jenisOperasi_v]");
    }
};
