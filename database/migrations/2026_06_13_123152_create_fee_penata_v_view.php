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
        DB::statement("CREATE VIEW dbo.fee_penata_v
AS
SELECT        TOP (100) PERCENT a.kode_trans_pelayanan, a.kode_tc_trans_kasir, a.no_kunjungan, a.no_registrasi, a.no_mr, a.nama_pasien_layan, a.kode_kelompok, a.kode_perusahaan, a.tgl_transaksi, a.jenis_tindakan, 
                         a.nama_tindakan, a.bill_rs, a.bill_dr1, a.bill_rs + a.bill_dr1 AS total, a.kode_dokter1 AS kode_dokter, a.jumlah, a.kode_tarif, a.kode_bagian, a.kode_klas, a.id_bedah, a.paket_sectio, a.status_batal, a.no_urut, 
                         a.flag_penata, b.seri_kuitansi, b.tgl_jam, dbo.mt_karyawan.id_status, dbo.tc_bedah.status_penata, b.no_kuitansi, a.flag_dr1, dbo.tc_registrasi.plafon_bpjs
FROM            dbo.tc_trans_pelayanan AS a INNER JOIN
                         dbo.tc_trans_kasir AS b ON b.kode_tc_trans_kasir = a.kode_tc_trans_kasir INNER JOIN
                         dbo.mt_karyawan ON a.kode_dokter1 = dbo.mt_karyawan.kode_dokter INNER JOIN
                         dbo.tc_registrasi ON a.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                         dbo.tc_bedah ON a.kode_klas = dbo.tc_bedah.kode_klas AND a.no_registrasi = dbo.tc_bedah.no_registrasi AND a.kode_tarif = dbo.tc_bedah.kode_tarif
GROUP BY a.kode_trans_pelayanan, a.kode_tc_trans_kasir, a.no_kunjungan, a.no_registrasi, a.no_mr, a.nama_pasien_layan, a.kode_kelompok, a.kode_perusahaan, a.tgl_transaksi, a.jenis_tindakan, a.nama_tindakan, 
                         a.bill_rs, a.bill_dr1, a.bill_rs + a.bill_dr1, a.kode_dokter1, a.jumlah, a.kode_tarif, a.kode_bagian, a.kode_klas, a.id_bedah, a.paket_sectio, a.status_batal, a.no_urut, a.flag_penata, b.seri_kuitansi, b.tgl_jam, 
                         dbo.mt_karyawan.id_status, dbo.tc_bedah.status_penata, b.no_kuitansi, a.flag_dr1, dbo.tc_registrasi.plafon_bpjs
HAVING        (a.kode_tc_trans_kasir > 0) AND (a.status_batal IS NULL) AND (a.nama_tindakan LIKE '%penata%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_penata_v]");
    }
};
