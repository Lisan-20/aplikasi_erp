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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_bedah_bpjs_trial2_v
AS
SELECT        mt_master_tarif_1.referensi, dbo.fee_bedah_bpjs_trial_v.plafon_bpjs, dbo.fee_bedah_bpjs_trial_v.bill, MONTH(dbo.fee_bedah_bpjs_trial_v.tgl_transaksi) AS bln, 
                         dbo.fee_bedah_bpjs_trial_v.kode_dokter1, dbo.mt_plafon_dokter_det.persen, 
                         dbo.mt_plafon_dokter_det.persen / 100 * dbo.fee_bedah_bpjs_trial_v.plafon_bpjs AS fee, dbo.mt_plafon_dokter_det.detail, dbo.mt_plafon_dokter_det.keterangan, 
                         dbo.fee_bedah_bpjs_trial_v.no_registrasi, dbo.fee_bedah_bpjs_trial_v.no_mr, dbo.fee_bedah_bpjs_trial_v.kode_trans_pelayanan, 
                         dbo.mt_plafon_dokter_det.katagori, dbo.fee_bedah_bpjs_trial_v.no_urut, dbo.fee_bedah_bpjs_trial_v.nama_tindakan, dbo.fee_bedah_bpjs_trial_v.kode_tarif
FROM            dbo.fee_bedah_bpjs_trial_v INNER JOIN
                         dbo.mt_master_tarif ON dbo.fee_bedah_bpjs_trial_v.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                         dbo.mt_master_tarif AS mt_master_tarif_1 ON dbo.mt_master_tarif.referensi = mt_master_tarif_1.kode_tarif LEFT OUTER JOIN
                         dbo.mt_plafon_dokter_det ON dbo.fee_bedah_bpjs_trial_v.no_urut = dbo.mt_plafon_dokter_det.no_urut AND 
                         mt_master_tarif_1.referensi = dbo.mt_plafon_dokter_det.katagori
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_bedah_bpjs_trial2_v]");
    }
};
