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
        DB::statement("CREATE VIEW dbo.ver_fee_ranap_bpjs_v
AS
SELECT        TOP (100) PERCENT a.kode_tc_trans_kasir, a.no_registrasi, a.no_mr, a.kode_kelompok, a.kode_perusahaan, a.jenis_tindakan, a.nama_tindakan, SUM(a.bill_rs) 
                         AS bill_rs, SUM(a.bill_dr1) AS bill_dr1, SUM(a.bill_dr2) AS bill_dr2, SUM(a.bill_dr3) AS bill_dr3, a.kode_dokter1, a.kode_dokter2, a.kode_dokter3, a.kode_bagian, 
                         a.kode_bagian_asal, a.kode_klas, a.no_kamar, a.no_bed, a.status_selesai, a.flag_dr1, a.flag_dr2, b.seri_kuitansi, b.tgl_jam, SUM(a.jumlah) AS jumlah, 
                         a.status_batal, dbo.tc_registrasi.kode_plafon, dbo.tc_registrasi.plafon_bpjs, a.kode_trans_pelayanan
FROM            dbo.tc_trans_pelayanan AS a INNER JOIN
                         dbo.tc_trans_kasir AS b ON b.kode_tc_trans_kasir = a.kode_tc_trans_kasir INNER JOIN
                         dbo.tc_registrasi ON b.no_registrasi = dbo.tc_registrasi.no_registrasi
GROUP BY a.kode_tc_trans_kasir, a.no_registrasi, a.no_mr, a.kode_kelompok, a.kode_perusahaan, a.jenis_tindakan, a.nama_tindakan, a.kode_dokter1, a.kode_dokter2, 
                         a.kode_dokter3, a.kode_bagian, a.kode_bagian_asal, a.kode_klas, a.no_kamar, a.no_bed, a.status_selesai, a.flag_dr1, a.flag_dr2, b.seri_kuitansi, b.tgl_jam, 
                         a.status_batal, dbo.tc_registrasi.kode_plafon, dbo.tc_registrasi.plafon_bpjs, a.kode_trans_pelayanan
HAVING        (a.kode_tc_trans_kasir > 0) AND (a.flag_dr1 IS NULL) AND (b.seri_kuitansi IN ('RI', 'AI')) AND (NOT (a.kode_kelompok IN (1, 3, 5))) AND (a.status_batal IS NULL) AND 
                         (b.tgl_jam BETWEEN CONVERT(DATETIME, '2017-03-31 00:00:00', 102) AND CONVERT(DATETIME, '2017-05-31 23:59:59', 102)) AND (SUM(a.bill_dr1) > 0) AND 
                         (NOT (a.kode_bagian IN ('030901'))) OR
                         (a.kode_tc_trans_kasir > 0) AND (a.flag_dr1 IS NULL) AND (b.seri_kuitansi IN ('RI', 'AI')) AND (NOT (a.kode_kelompok IN (1, 3, 5))) AND (a.status_batal IS NULL) AND 
                         (b.tgl_jam BETWEEN CONVERT(DATETIME, '2017-03-31 00:00:00', 102) AND CONVERT(DATETIME, '2017-05-31 23:59:59', 102)) AND (SUM(a.bill_dr2) > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ver_fee_ranap_bpjs_v]");
    }
};
