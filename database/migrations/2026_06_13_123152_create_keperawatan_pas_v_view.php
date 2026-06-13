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
        DB::statement("CREATE OR ALTER VIEW dbo.keperawatan_pas_v
AS
SELECT        dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_agama, dbo.ri_tc_rawatinap.kode_ri, dbo.ri_tc_rawatinap.tgl_masuk, 
                         dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.tgl_transaksi, 
                         dbo.tc_trans_pelayanan.no_kamar, dbo.ri_tc_rawatinap.no_kunjungan, dbo.tc_trans_pelayanan.kode_paramedis
FROM            dbo.ri_tc_rawatinap INNER JOIN
                         dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                         dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                         dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan
WHERE        (dbo.tc_trans_pelayanan.jenis_tindakan IN (3, 4))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [keperawatan_pas_v]");
    }
};
