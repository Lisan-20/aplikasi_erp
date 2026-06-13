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
        DB::statement("CREATE VIEW dbo.cek_pegawai_v
AS
SELECT     no_induk, urutan_karyawan, nama_pegawai, kode_jabatan, kode_bagian, kode_dokter, kode_spesialisasi, status_dr, status, available, jatah_kelas, level_id, no_mr, 
                      flag_anes, flag_aktif, tgl_lahir, tmp_lahir, tlp, id_sex, id_status, id_dc_kawin, gaji_pokok, nama_bank, no_rekening, bank_cabang, alamat, kode_bagian_gaji, 
                      id_dc_agama, tmt_bekerja, tinggi_Badan, berat_badan, gol_darah, suku, kota, propinsi, nama_panggilan, no_ktp, no_sim, ketenagakerjaan_1, ketenagakerjaan_2, 
                      npwp, tgl_akhir_ktp, ko_wil, level_pegawai, kode_paramedis, flag_paramedis, no_finger, npp, gf_dokter, ket_gf_dokter, kd, jml_sittiing, nominal_fee, flag_sitDay, 
                      flag_sitMonth, wajib_absen, insentif_dr, ketenagakerjaan_3
FROM         dbo.mt_karyawan
WHERE     (npp IN
                          (SELECT     npp
                            FROM          dbo.tc_gaji_tiap_bulan
                            WHERE      (bulan = 4) AND (tahun = 2018))) AND (kode_dokter IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_pegawai_v]");
    }
};
