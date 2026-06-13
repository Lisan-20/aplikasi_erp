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
        DB::statement("CREATE VIEW dbo.pindah_bill_operasi_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.jumlah, dbo.mt_master_tarif_detail_bedah.total, 
                      dbo.mt_master_tarif_detail_bedah.detail
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_master_tarif.referensi = dbo.mt_master_tarif_detail_bedah.kode_tarif AND 
                      dbo.tc_trans_pelayanan.no_urut = dbo.mt_master_tarif_detail_bedah.no_urut AND 
                      dbo.tc_trans_pelayanan.kode_klas = dbo.mt_master_tarif_detail_bedah.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pindah_bill_operasi_v]");
    }
};
