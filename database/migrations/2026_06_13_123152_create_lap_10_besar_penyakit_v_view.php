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
        DB::statement("CREATE VIEW dbo.lap_10_besar_penyakit_v
AS
SELECT     CASE WHEN MONTH(dbo.tc_registrasi.tgl_jam_masuk) IS NULL THEN MONTH(dbo.tc_registrasi.tgl_jam_masuk) ELSE MONTH(dbo.tc_registrasi.tgl_jam_masuk) END AS bulan, 
                      CASE WHEN year(dbo.tc_registrasi.tgl_jam_masuk) IS NULL THEN year(dbo.tc_registrasi.tgl_jam_masuk) ELSE year(dbo.tc_registrasi.tgl_jam_masuk) END AS tahun, dbo.th_icd10_pasien.kode_icd,
                       dbo.th_icd10_pasien.tipe_rl, SUBSTRING(dbo.th_icd10_pasien.kode_bagian, 1, 2) AS kobag, dbo.th_icd10_pasien.kode_bagian, dbo.mt_master_icd10.nama_icd AS nama_icd_10, 
                      CASE WHEN dbo.th_icd10_pasien.tgl_jam IS NULL THEN dbo.th_icd10_pasien.tgl_input ELSE tgl_jam END AS tgl_jam, dbo.th_icd10_pasien.no_mr, dbo.th_icd10_pasien.kode_asterik, 
                      dbo.th_icd10_pasien.group_depkes, dbo.th_icd10_pasien.no_registrasi, dbo.th_icd10_pasien.kode_dokter, dbo.th_icd10_pasien.diagnosa, dbo.th_icd10_pasien.umur, 
                      dbo.th_icd10_pasien.status_itung, dbo.th_icd10_pasien.status_hidup, dbo.th_icd10_pasien.jns_penyakit, dbo.th_icd10_pasien.user_id, dbo.tc_registrasi.tgl_jam_masuk, 
                      dbo.mt_master_pasien.jen_kelamin AS gender, dbo.th_icd10_pasien.no_kunjungan
FROM         dbo.th_icd10_pasien INNER JOIN
                      dbo.mt_master_icd10 ON dbo.th_icd10_pasien.kode_icd = dbo.mt_master_icd10.icd_10 INNER JOIN
                      dbo.tc_registrasi ON dbo.th_icd10_pasien.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.th_icd10_pasien.no_mr = dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_10_besar_penyakit_v]");
    }
};
