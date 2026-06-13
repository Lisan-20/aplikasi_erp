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
        DB::statement("CREATE VIEW dbo.bedah_sum_v
AS
SELECT        TOP (100) PERCENT SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) AS rs, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                         * dbo.tc_trans_pelayanan.bill_dr1) AS dr, dbo.tc_trans_pelayanan.nama_tindakan
FROM            dbo.tc_trans_pelayanan INNER JOIN
                         dbo.ri_tc_riwayat_kelas ON dbo.tc_trans_pelayanan.no_registrasi = dbo.ri_tc_riwayat_kelas.no_registrasi INNER JOIN
                         dbo.mt_jenis_tindakan ON dbo.tc_trans_pelayanan.jenis_tindakan = dbo.mt_jenis_tindakan.kode_jenis_tindakan INNER JOIN
                         dbo.tc_registrasi ON dbo.ri_tc_riwayat_kelas.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE        (dbo.tc_registrasi.tgl_jam_keluar IS NOT NULL) AND (dbo.tc_trans_pelayanan.kode_kelompok IN (8, 9, 10, 11, 12)) AND (NOT (dbo.tc_trans_pelayanan.no_registrasi IN
                             (SELECT        no_registrasi
                               FROM            dbo.tc_kunjungan AS tc_kunjungan_1
                               WHERE        (kode_bagian_tujuan IN (031001))))) AND (YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) = 2016) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) = 12)
GROUP BY dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jenis_tindakan
HAVING        (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan IN ('4'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bedah_sum_v]");
    }
};
