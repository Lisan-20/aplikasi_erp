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
        DB::statement("CREATE VIEW dbo.fee_bedah_bpjs_trial3_v
AS
SELECT        plafon_bpjs, bill, persen, CASE WHEN no_urut = 10 THEN 200000 ELSE fee END AS fee, referensi, no_urut, kode_trans_pelayanan, keterangan, no_registrasi, 
                         no_mr, nama_tindakan, kode_tarif
FROM            dbo.fee_bedah_bpjs_trial2_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_bedah_bpjs_trial3_v]");
    }
};
