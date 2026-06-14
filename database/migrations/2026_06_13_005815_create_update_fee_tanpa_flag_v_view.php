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
        DB::statement("CREATE OR ALTER VIEW dbo.update_fee_tanpa_flag_v
AS
SELECT     TOP (100) PERCENT dbo.fee_dokter_rinap_temp.no_registrasi, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.flag_dr1, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.fee_dokter_rinap_temp.flag_sppu
FROM         dbo.fee_dokter_rinap_temp INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.fee_dokter_rinap_temp.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi AND 
                      dbo.fee_dokter_rinap_temp.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
WHERE     (dbo.tc_trans_pelayanan.flag_dr1 IS NULL) AND (dbo.fee_dokter_rinap_temp.flag_sppu = 1)
ORDER BY dbo.tc_trans_pelayanan.nama_tindakan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_fee_tanpa_flag_v]");
    }
};
