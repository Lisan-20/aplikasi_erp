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
        DB::statement("CREATE VIEW dbo.v_pindah_billing_obat
AS
SELECT     kode_trans_pelayanan, no_kunjungan, no_registrasi, bill_rs, bill_rs_jatah, jenis_tindakan, nama_tindakan
FROM         dbo.tc_trans_pelayanan
WHERE     (jenis_tindakan IN (7, 9, 11)) AND (kode_tc_trans_kasir IS NULL OR
                      kode_tc_trans_kasir = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_pindah_billing_obat]");
    }
};
