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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_gaji_bagian_v
AS
SELECT     dbo.tc_gaji_tiap_bulan.id_tc_thp, dbo.tc_gaji_tiap_bulan.id_periode_gaji, dbo.tc_gaji_tiap_bulan.periode, dbo.tc_gaji_tiap_bulan.tahun, dbo.tc_gaji_tiap_bulan.bulan, 
                      dbo.tc_gaji_tiap_bulan.no_induk, dbo.tc_gaji_tiap_bulan.nama_pegawai, dbo.tc_gaji_tiap_bulan.gaji_pokok, dbo.tc_gaji_tiap_bulan.tunj_jabatan, dbo.tc_gaji_tiap_bulan.tunj_resiko, 
                      dbo.tc_gaji_tiap_bulan.tunj_jaga_malam, dbo.tc_gaji_tiap_bulan.tunj_performa, dbo.tc_gaji_tiap_bulan.tunj_transport, dbo.tc_gaji_tiap_bulan.tunj_uang_makan, dbo.tc_gaji_tiap_bulan.tunj_lain, 
                      dbo.tc_gaji_tiap_bulan.gaji_kotor, dbo.tc_gaji_tiap_bulan.pot_BPJS_kesehatan, dbo.tc_gaji_tiap_bulan.pot_BPJS_jht, dbo.tc_gaji_tiap_bulan.pot_BPJS_jp, dbo.tc_gaji_tiap_bulan.pot_bank, 
                      dbo.tc_gaji_tiap_bulan.pot_payroll, dbo.tc_gaji_tiap_bulan.pot_pinjaman, dbo.tc_gaji_tiap_bulan.pot_obat, dbo.tc_gaji_tiap_bulan.pot_selisih_iuran, dbo.tc_gaji_tiap_bulan.pot_lain, 
                      dbo.tc_gaji_tiap_bulan.lembur, dbo.tc_gaji_tiap_bulan.insentif, dbo.tc_gaji_tiap_bulan.thp, dbo.tc_gaji_tiap_bulan.bruto1thn, dbo.tc_gaji_tiap_bulan.netto1thn, dbo.tc_gaji_tiap_bulan.ptkp_jenis, 
                      dbo.tc_gaji_tiap_bulan.ptkp, dbo.tc_gaji_tiap_bulan.pkp, dbo.tc_gaji_tiap_bulan.pph21, dbo.tc_gaji_tiap_bulan.pph21_bln, dbo.tc_gaji_tiap_bulan.gross, dbo.tc_gaji_tiap_bulan.gross_bln, 
                      dbo.tc_gaji_tiap_bulan.input_id, dbo.tc_gaji_tiap_bulan.input_tgl, dbo.tc_gaji_tiap_bulan.status, dbo.tc_gaji_tiap_bulan.status_tgl, dbo.tc_gaji_tiap_bulan.no_bukti, dbo.tc_gaji_tiap_bulan.npp, 
                      dbo.tc_gaji_tiap_bulan.flag_final, dbo.tc_gaji_tiap_bulan.status_ver, dbo.tc_gaji_tiap_bulan.user_ver, dbo.tc_gaji_tiap_bulan.tgl_ver, dbo.mt_karyawan.kode_bagian, 
                      dbo.tc_gaji_tiap_bulan.pot_indisipliner, dbo.tc_gaji_tiap_bulan.bonus_kinerja, dbo.tc_gaji_tiap_bulan.dana_pendidikan, dbo.tc_gaji_tiap_bulan.bonus_tahunan
FROM         dbo.tc_gaji_tiap_bulan INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_gaji_tiap_bulan.npp = dbo.mt_karyawan.npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_gaji_bagian_v]");
    }
};
