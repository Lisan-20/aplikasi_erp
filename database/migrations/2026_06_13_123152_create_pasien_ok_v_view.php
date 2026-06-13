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
        DB::statement("CREATE VIEW dbo.pasien_ok_v
AS
SELECT     no_registrasi
FROM         dbo.tc_kunjungan
WHERE     (kode_bagian_tujuan IN (030501, 030901)) AND (no_registrasi NOT IN
                          (SELECT     no_registrasi
                            FROM          dbo.tc_kunjungan AS tc_kunjungan_1
                            WHERE      (kode_bagian_tujuan IN (031001))))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_ok_v]");
    }
};
