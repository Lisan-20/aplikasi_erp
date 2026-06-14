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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_tc_hasilpenunjang_foto_dr_radio_v
AS
SELECT     dbo.pm_tc_hasilpenunjang_foto.kode_trans_pelayanan, dbo.pm_tc_hasilpenunjang_foto.id, dbo.tc_trans_pelayanan.no_mr, dbo.pm_tc_hasilpenunjang_foto.dihapus_pada, 
                      dbo.pm_tc_hasilpenunjang_foto.foto, dbo.pm_tc_hasilpenunjang_foto.nomor, dbo.pm_tc_hasilpenunjang_foto.ext, dbo.pm_tc_hasilpenunjang.hasil, dbo.pm_tc_hasilpenunjang.keterangan, 
                      dbo.pm_mt_standarhasil.nama_pemeriksaan, dbo.tc_trans_pelayanan.kode_penunjang, dbo.tc_trans_pelayanan.nama_tindakan, dbo.pm_mt_standarhasil.standar_hasil_wanita, 
                      dbo.pm_mt_standarhasil.standar_hasil_pria, dbo.pm_mt_standarhasil.kode_mt_hasilpm, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_dokter1, dbo.data_foto_v.id AS kode, 
                      dbo.pm_tc_hasilpenunjang.kode_tc_hasilpenunjang, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.no_registrasi
FROM         dbo.pm_tc_hasilpenunjang_foto INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_tc_hasilpenunjang_foto.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan INNER JOIN
                      dbo.pm_mt_standarhasil ON dbo.tc_trans_pelayanan.kode_tarif = dbo.pm_mt_standarhasil.kode_tarif LEFT OUTER JOIN
                      dbo.data_foto_v ON dbo.pm_tc_hasilpenunjang_foto.id = dbo.data_foto_v.id LEFT OUTER JOIN
                      dbo.pm_tc_hasilpenunjang ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan
WHERE     (dbo.pm_tc_hasilpenunjang_foto.dihapus_pada IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_tc_hasilpenunjang_foto_dr_radio_v]");
    }
};
