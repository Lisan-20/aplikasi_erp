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
        DB::statement("CREATE VIEW dbo.update_fee_bpjs_rinap_v
AS
SELECT        dbo.fee_bedah_bpjs_trial3_v.bill, dbo.fee_bedah_bpjs_trial3_v.plafon_bpjs, dbo.fee_bedah_bpjs_trial3_v.fee, dbo.fee_dokter_rinap_temp.jumlah, 
                         dbo.fee_dokter_rinap_temp.nama_tindakan, dbo.fee_dokter_rinap_temp.no_registrasi, dbo.fee_dokter_rinap_temp.no_mr, dbo.fee_bedah_bpjs_trial3_v.no_urut, 
                         dbo.fee_dokter_rinap_temp.kode_kelompok, dbo.fee_dokter_rinap_temp.fee_bpjs, dbo.fee_dokter_rinap_temp.no_sppu, dbo.fee_dokter_rinap_temp.flag_sppu, 
                         CASE WHEN fee > jumlah THEN fee ELSE jumlah END AS feenya, dbo.fee_bedah_bpjs_trial3_v.kode_tarif
FROM            dbo.fee_dokter_rinap_temp INNER JOIN
                         dbo.fee_bedah_bpjs_trial3_v ON dbo.fee_dokter_rinap_temp.kode_trans_pelayanan = dbo.fee_bedah_bpjs_trial3_v.kode_trans_pelayanan
WHERE        (NOT (dbo.fee_dokter_rinap_temp.kode_kelompok IN (1, 3, 5))) AND (dbo.fee_dokter_rinap_temp.fee_bpjs IS NULL) AND (dbo.fee_bedah_bpjs_trial3_v.fee > 0) AND 
                         (dbo.fee_dokter_rinap_temp.flag_sppu IS NULL) AND (dbo.fee_bedah_bpjs_trial3_v.plafon_bpjs > dbo.fee_bedah_bpjs_trial3_v.bill)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_fee_bpjs_rinap_v]");
    }
};
