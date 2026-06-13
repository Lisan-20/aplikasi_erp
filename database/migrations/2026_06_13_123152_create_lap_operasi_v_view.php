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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_operasi_v
AS
SELECT     dbo.tc_bedah.kode_tarif, dbo.tc_bedah.nama_tindakan, dbo.tc_bedah.kode_dr_bedah, dbo.tc_bedah.kode_dr_anestesi, dbo.tc_bedah.tgl_transaksi, 
                      dbo.tc_bedah.tgl_jam_masuk, dbo.tc_bedah.tgl_jam_keluar, dbo.tc_bedah.tgl_jam_mulai, dbo.tc_bedah.tgl_jam_selesai, dbo.tc_bedah.no_mr, 
                      dbo.tc_bedah.nama_pasien, dbo.tc_bedah.no_registrasi, dbo.tc_bedah.no_kunjungan, dbo.tc_bedah.kode_bagian, dbo.tc_bedah.kode_klas, 
                      dbo.tc_bedah.no_bed, dbo.tc_bedah.kode_kelompok, dbo.tc_bedah.kode_perusahaan, dbo.tc_bedah.umur, dbo.tc_bedah.tgl_lahir, 
                      dbo.tc_bedah.alamat, dbo.tc_bedah.jenis_anestesi, dbo.tc_bedah.icd_diagnosa, dbo.tc_bedah.keterangan, mt_master_tarif_1.nama_tarif AS golongan, 
                      dbo.mt_master_pasien.jen_kelamin
FROM         dbo.tc_bedah INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_bedah.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_master_tarif AS mt_master_tarif_1 ON dbo.mt_master_tarif.referensi = mt_master_tarif_1.kode_tarif INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_bedah.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_bedah.no_mr = dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_operasi_v]");
    }
};
