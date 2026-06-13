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
        DB::statement("CREATE VIEW dbo.v_bill_dokter_ri_fee_bpjs
AS
SELECT     dbo.fee_dokter_rinap_temp.kode_dr, dbo.fee_dokter_rinap_temp.kode_trans_pelayanan, dbo.mt_karyawan.nama_pegawai, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.bill_dr1_jatah, 
                      dbo.tc_trans_pelayanan.bill_dr2_jatah, dbo.tc_trans_pelayanan.bill_rs_jatah, 
                      dbo.tc_trans_pelayanan.bill_dr1_jatah + dbo.tc_trans_pelayanan.bill_dr2_jatah + dbo.tc_trans_pelayanan.bill_rs_jatah AS bill
FROM         dbo.fee_dokter_rinap_temp INNER JOIN
                      dbo.mt_karyawan ON dbo.fee_dokter_rinap_temp.kode_dr = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.fee_dokter_rinap_temp.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
WHERE     (dbo.fee_dokter_rinap_temp.kode_dr IN (128, 162, 121)) AND (dbo.tc_trans_pelayanan.kode_kelompok IN (8, 9))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_bill_dokter_ri_fee_bpjs]");
    }
};
