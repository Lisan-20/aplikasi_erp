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
        DB::statement("CREATE VIEW dbo.resum_obat_lengkap_temp_v
AS
SELECT     kode_trans_far, tgl_transaksi, no_registrasi
FROM         dbo.resum_obat_lengkap_temp
GROUP BY kode_trans_far, tgl_transaksi, no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [resum_obat_lengkap_temp_v]");
    }
};
