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
        DB::statement("CREATE VIEW dbo.upd_ri_tc_ranap_v
AS
SELECT     TOP (100) PERCENT dbo.ri_tc_rawatinap.kode_ri, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.no_bed, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.no_induk, dbo.tc_registrasi.tgl_input, dbo.tc_registrasi.diagnosa, dbo.tc_registrasi.no_jaminan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 1) AND (dbo.tc_trans_pelayanan.kode_ri = 0)
ORDER BY dbo.tc_trans_pelayanan.tgl_transaksi DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_ri_tc_ranap_v]");
    }
};
