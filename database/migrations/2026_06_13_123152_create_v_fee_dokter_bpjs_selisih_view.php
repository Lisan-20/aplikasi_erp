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
        DB::statement("CREATE VIEW dbo.v_fee_dokter_bpjs_selisih
AS
SELECT     dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.kode_trans_pelayanan, 
                      dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.kode_dokter1, 
                      dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.flag_dr1, dbo.tc_registrasi.byr_selisih, dbo.tc_registrasi.kode_kelompok, dbo.mt_bagian.id_jenis_layanan, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_kasir.nama_pasien, dbo.mt_plafon_bpjs_detail.persen_dr, dbo.tc_registrasi.kode_plafon
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi AND 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_plafon_bpjs_detail ON dbo.tc_registrasi.kode_plafon = dbo.mt_plafon_bpjs_detail.kode_plafon AND 
                      dbo.mt_bagian.id_jenis_layanan = dbo.mt_plafon_bpjs_detail.id_jenis_layanan
WHERE     (dbo.tc_registrasi.kode_kelompok IN (9, 10)) AND (dbo.tc_registrasi.byr_selisih = 1) AND (dbo.tc_trans_pelayanan.bill_dr1 > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_fee_dokter_bpjs_selisih]");
    }
};
