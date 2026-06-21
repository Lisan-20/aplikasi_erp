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
        DB::statement("CREATE OR ALTER VIEW dbo.update_dokter_trans_pelayanan_v
AS
SELECT     dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_registrasi.kode_dokter, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.kode_bagian NOT LIKE '03%') AND (dbo.tc_trans_pelayanan.kode_dokter1 IS NULL) AND (dbo.tc_trans_pelayanan.bill_dr1 > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_dokter_trans_pelayanan_v]");
    }
};
