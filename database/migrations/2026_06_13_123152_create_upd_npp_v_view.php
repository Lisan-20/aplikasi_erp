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
        DB::statement("CREATE VIEW dbo.upd_npp_v
AS
SELECT     TOP (100) PERCENT no_induk, urutan_karyawan, nama_pegawai, kode_jabatan, kode_bagian, kode_dokter, kode_spesialisasi, status_dr, status, available, 
                      jatah_kelas, level_id, no_mr, flag_anes, flag_aktif, tgl_lahir, tmp_lahir, tlp, id_sex, id_status, id_dc_kawin, gaji_pokok, npp, nama_bank, no_rekening, bank_cabang, 
                      alamat, kode_bagian_gaji, id_dc_agama, tmt_bekerja, npp_lama, npp_baru, row_number() over (order by no_induk) as npp_upd
FROM         dbo.mt_karyawan
WHERE     (npp <> '') 
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_npp_v]");
    }
};
