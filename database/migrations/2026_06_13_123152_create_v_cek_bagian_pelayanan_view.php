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
        DB::statement("CREATE VIEW dbo.v_cek_bagian_pelayanan
AS
SELECT     kode_tc_trans_kasir, kode_bagian, no_registrasi
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_tc_trans_kasir, kode_bagian, no_registrasi
HAVING      (kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_bagian_pelayanan]");
    }
};
