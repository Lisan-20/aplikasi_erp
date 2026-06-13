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
        DB::statement("CREATE VIEW dbo.th_icd10_pasien_oke_v
AS
SELECT     dbo.th_riwayat_pasien.kode_riwayat, dbo.th_riwayat_pasien.no_registrasi, dbo.th_riwayat_pasien.no_kunjungan, dbo.th_riwayat_pasien.no_mr, 
                      dbo.th_riwayat_pasien.diagnosa_awal, dbo.th_riwayat_pasien.anamnesa, dbo.th_riwayat_pasien.pengobatan, dbo.th_riwayat_pasien.diagnosa_akhir, 
                      dbo.th_icd10_pasien.kode_icd, dbo.mt_master_icd10.nama_icd, dbo.th_icd10_pasien.tipe_rl, dbo.th_icd10_pasien.jns_penyakit, dbo.th_icd10_pasien.tgl_jam, 
                      dbo.th_icd10_pasien.kode_icd_pasien, dbo.th_riwayat_pasien.flag_jenis_diag, dbo.th_riwayat_pasien.tgl_input
FROM         dbo.th_icd10_pasien INNER JOIN
                      dbo.th_riwayat_pasien ON dbo.th_icd10_pasien.no_kunjungan = dbo.th_riwayat_pasien.no_kunjungan AND 
                      dbo.th_icd10_pasien.kode_riwayat = dbo.th_riwayat_pasien.kode_riwayat INNER JOIN
                      dbo.mt_master_icd10 ON dbo.th_icd10_pasien.kode_icd = dbo.mt_master_icd10.icd_10
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_icd10_pasien_oke_v]");
    }
};
