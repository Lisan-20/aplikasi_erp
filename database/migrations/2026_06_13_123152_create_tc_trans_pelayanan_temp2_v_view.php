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
        DB::statement("CREATE VIEW dbo.tc_trans_pelayanan_temp2_v
AS
SELECT     no_kunjungan, tgl_transaksi, kode_bagian, no_registrasi, kode_penunjang
FROM         dbo.tc_trans_pelayanan_temp
GROUP BY no_kunjungan, tgl_transaksi, kode_bagian, no_registrasi, kode_penunjang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_pelayanan_temp2_v]");
    }
};
