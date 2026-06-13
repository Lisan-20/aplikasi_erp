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
        DB::statement("CREATE VIEW dbo.UPD_BILL_BPJS
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.bill_rs_bpjs, 
                      dbo.mt_master_tarif_detail.bill_dr1_bpjs, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs_jatah, 
                      dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.kode_tarif
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif_detail.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif AND 
                      dbo.mt_master_tarif_detail.kode_klas <> dbo.tc_trans_pelayanan.kode_klas
WHERE     (dbo.tc_trans_pelayanan.no_registrasi = 797) AND (dbo.mt_master_tarif_detail.kode_klas = 6) AND (dbo.tc_trans_pelayanan.kode_bagian <> '030901')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [UPD_BILL_BPJS]");
    }
};
