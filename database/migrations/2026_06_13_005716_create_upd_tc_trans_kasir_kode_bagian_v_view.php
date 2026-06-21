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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_tc_trans_kasir_kode_bagian_v
AS
SELECT     dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_trans_kasir.kode_bagian, dbo.tc_registrasi.no_registrasi
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.tc_trans_kasir.kode_bagian = ' ')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tc_trans_kasir_kode_bagian_v]");
    }
};
