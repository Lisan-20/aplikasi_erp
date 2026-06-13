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
        DB::statement("CREATE VIEW dbo.cek_pelayanan_far_v
AS
SELECT     TOP (100) PERCENT dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.kode_bagian, 
                      dbo.fr_tc_far.kode_bagian_asal, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.tgl_jam_keluar
FROM         dbo.fr_tc_far LEFT OUTER JOIN
                      dbo.tc_registrasi ON dbo.fr_tc_far.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (NOT (dbo.fr_tc_far.kode_trans_far IN
                          (SELECT     kode_trans_far
                            FROM          dbo.tc_trans_pelayanan
                            WHERE      (kode_trans_far IS NOT NULL)))) AND (dbo.fr_tc_far.status_transaksi IS NOT NULL) AND (dbo.tc_registrasi.tgl_jam_keluar IS NULL) AND 
                      (dbo.fr_tc_far.kode_bagian_asal LIKE '03%')
ORDER BY dbo.fr_tc_far.tgl_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_pelayanan_far_v]");
    }
};
