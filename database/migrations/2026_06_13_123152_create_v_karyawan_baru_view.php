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
        DB::statement("CREATE OR ALTER VIEW dbo.v_karyawan_baru
AS
SELECT     TOP (200) no_induk, urutan_karyawan, nama_pegawai, kode_jabatan, kode_bagian, kode_dokter, kode_spesialisasi, status_dr, status, available, jatah_kelas, 
                      level_id, no_mr, flag_anes, flag_aktif, tgl_lahir, tmp_lahir, tlp, id_sex, id_status, id_dc_kawin, gaji_pokok, nama_bank, no_rekening, bank_cabang, alamat, 
                      kode_bagian_gaji, id_dc_agama, tmt_bekerja, tinggi_Badan, berat_badan, gol_darah, suku, kota, propinsi, nama_panggilan, no_ktp, no_sim, ketenagakerjaan_1, 
                      ketenagakerjaan_2, npwp, tgl_akhir_ktp, ko_wil, level_pegawai, kode_paramedis, flag_paramedis, no_finger, npp, gf_dokter, ket_gf_dokter, kd, jml_sittiing, 
                      nominal_fee, flag_sitDay, flag_sitMonth, wajib_absen, insentif_dr, ketenagakerjaan_3
FROM         dbo.mt_karyawan
WHERE     (npp IN (5514120218, 5543120318, 5536120318, 5528210218, 5530210218, 5531080318, 5518210218, 5520210218, 5526210218, 5546010218, 5522210218, 
                      5529210218, 5510151217, 5532120318, 5516210218, 5542120318, 5540120318, 5533120318, 5535120318, 5544120318, 5545120318, 5519210218, 5521210218, 
                      5547070318, 5515210218, 5539120318, 5527210218, 5525210218, 5534120318, 5541120318, 5524210218, 5517210218))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_karyawan_baru]");
    }
};
