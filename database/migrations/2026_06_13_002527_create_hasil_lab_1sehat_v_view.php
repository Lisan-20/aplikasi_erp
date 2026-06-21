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
        DB::statement("CREATE OR ALTER VIEW dbo.hasil_lab_1sehat_v
AS
SELECT     dbo.pm_tc_penunjang.kode_penunjang, dbo.pm_tc_hasilpenunjang.hasil, dbo.pm_tc_hasilpenunjang.keterangan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.kode_tarif, 
                      dbo.pm_mt_standarhasil.kode_speciment, dbo.pm_mt_standarhasil.kode_pemeriksaan_det, dbo.pm_mt_standarhasil.kode_pemeriksaan, dbo.pm_tc_penunjang.kode_bagian, 
                      dbo.mt_speciment_1sehat.speciment
FROM         dbo.mt_speciment_1sehat INNER JOIN
                      dbo.pm_mt_standarhasil ON dbo.mt_speciment_1sehat.code = dbo.pm_mt_standarhasil.kode_speciment INNER JOIN
                      dbo.pm_tc_penunjang INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_tc_penunjang.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan INNER JOIN
                      dbo.pm_tc_hasilpenunjang ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan ON 
                      dbo.pm_mt_standarhasil.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif
WHERE     (dbo.pm_tc_penunjang.kode_bagian = '050101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hasil_lab_1sehat_v]");
    }
};
