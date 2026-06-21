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
        DB::statement("CREATE OR ALTER VIEW dbo.v_cek_bagian_pelayanan_2
AS
SELECT     kode_tc_trans_kasir, kode_bagian, no_registrasi, kode_bagian_asal
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_tc_trans_kasir, kode_bagian, no_registrasi, kode_bagian_asal
HAVING      (kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_bagian_pelayanan_2]");
    }
};
