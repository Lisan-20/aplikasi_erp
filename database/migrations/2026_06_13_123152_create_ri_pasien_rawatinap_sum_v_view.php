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
        DB::statement("CREATE VIEW dbo.ri_pasien_rawatinap_sum_v
AS
SELECT     bln_masuk, thn_masuk, bln_keluar, thn_keluar, COUNT(no_registrasi) AS jumlah_pasien
FROM         dbo.ri_pasien_masuk_v
GROUP BY bln_masuk, thn_masuk, bln_keluar, thn_keluar
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_pasien_rawatinap_sum_v]");
    }
};
