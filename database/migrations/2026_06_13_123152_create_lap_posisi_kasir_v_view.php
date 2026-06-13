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
        DB::statement("CREATE VIEW dbo.lap_posisi_kasir_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar AS tgl_jam, SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END) AS bill_rs, 
                      SUM(CASE WHEN bill_dr1 IS NULL THEN 0 ELSE bill_dr1 END) AS bill_dr1, SUM(CASE WHEN bill_dr2 IS NULL THEN 0 ELSE bill_dr2 END) AS bill_dr2, 
                      SUM(CASE WHEN bill_rs_jatah IS NULL THEN 0 ELSE bill_rs_jatah END) AS bill_rs_jatah, SUM(CASE WHEN bill_dr1_jatah IS NULL THEN 0 ELSE bill_dr1_jatah END) 
                      AS bill_dr1_jatah, SUM(CASE WHEN bill_dr2_jatah IS NULL THEN 0 ELSE bill_dr2_jatah END) AS bill_dr2_jatah, SUM(CASE WHEN diskon_rs IS NULL 
                      THEN 0 ELSE diskon_rs END) AS diskon_rs, SUM(CASE WHEN diskon_dr1 IS NULL THEN 0 ELSE diskon_dr1 END) AS diskon_dr1, 
                      SUM(CASE WHEN diskon_dr2 IS NULL THEN 0 ELSE diskon_dr2 END) AS diskon_dr2, SUM(CASE WHEN lain_lain IS NULL THEN 0 ELSE lain_lain END) AS lain_lain, 
                      dbo.tc_trans_pelayanan.nama_pasien_layan AS nama_pasien, dbo.tc_registrasi.kode_bagian_keluar
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_registrasi.kode_bagian_keluar
HAVING      (dbo.tc_trans_pelayanan.status_selesai = 2) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL OR
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = 0) AND (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_posisi_kasir_v]");
    }
};
