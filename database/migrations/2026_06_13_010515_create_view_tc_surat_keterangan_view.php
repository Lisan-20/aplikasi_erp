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
        DB::statement("CREATE OR ALTER VIEW dbo.view_tc_surat_keterangan
AS
SELECT     dbo.tc_surat_keterangan.id_surat, dbo.tc_surat_keterangan.no_surat, dbo.tc_surat_keterangan.id_jenis_surat, dbo.tc_surat_keterangan.no_mr, dbo.tc_surat_keterangan.no_registrasi, 
                      dbo.tc_surat_keterangan.tgl_surat, dbo.tc_surat_keterangan.tgl_periksa, dbo.tc_surat_keterangan.nama_pasien, dbo.tc_surat_keterangan.lama_skd, dbo.tc_surat_keterangan.tgl_awal, 
                      dbo.tc_surat_keterangan.tgl_akhir, dbo.tc_surat_keterangan.kode_bagian, dbo.tc_surat_keterangan.kd_dokter, dbo.tc_surat_keterangan.no_urut_surat, dbo.tc_surat_keterangan.umur, 
                      dbo.tc_surat_keterangan.nama_ortu, dbo.tc_surat_keterangan.umur_ortu, dbo.tc_surat_keterangan.nama_perusahaan, dbo.tc_surat_keterangan.alamat_ortu, dbo.tc_surat_keterangan.umurnya_ortu, 
                      dbo.tc_surat_keterangan.ket_sehat, dbo.tc_surat_keterangan.isi_G, dbo.tc_surat_keterangan.isi_P, dbo.tc_surat_keterangan.isi_A, dbo.tc_surat_keterangan.taksiran_persalinan, 
                      dbo.tc_surat_keterangan.isi_hamil, dbo.tc_pemeriksaan_dokter_v2.nama_pemeriksaan, dbo.tc_pemeriksaan_dokter_v2.hasil, dbo.tc_pemeriksaan_dokter_v2.ket_hasil, 
                      dbo.tc_pemeriksaan_dokter_v2.kode_pemeriksaan
FROM         dbo.tc_surat_keterangan LEFT OUTER JOIN
                      dbo.tc_pemeriksaan_dokter_v2 ON dbo.tc_surat_keterangan.no_registrasi = dbo.tc_pemeriksaan_dokter_v2.no_registrasi
GROUP BY dbo.tc_surat_keterangan.id_surat, dbo.tc_surat_keterangan.no_surat, dbo.tc_surat_keterangan.id_jenis_surat, dbo.tc_surat_keterangan.no_mr, dbo.tc_surat_keterangan.no_registrasi, 
                      dbo.tc_surat_keterangan.tgl_surat, dbo.tc_surat_keterangan.tgl_periksa, dbo.tc_surat_keterangan.nama_pasien, dbo.tc_surat_keterangan.lama_skd, dbo.tc_surat_keterangan.tgl_awal, 
                      dbo.tc_surat_keterangan.tgl_akhir, dbo.tc_surat_keterangan.kode_bagian, dbo.tc_surat_keterangan.kd_dokter, dbo.tc_surat_keterangan.no_urut_surat, dbo.tc_surat_keterangan.umur, 
                      dbo.tc_surat_keterangan.nama_ortu, dbo.tc_surat_keterangan.umur_ortu, dbo.tc_surat_keterangan.nama_perusahaan, dbo.tc_surat_keterangan.alamat_ortu, dbo.tc_surat_keterangan.umurnya_ortu, 
                      dbo.tc_surat_keterangan.ket_sehat, dbo.tc_surat_keterangan.isi_G, dbo.tc_surat_keterangan.isi_P, dbo.tc_surat_keterangan.isi_A, dbo.tc_surat_keterangan.taksiran_persalinan, 
                      dbo.tc_surat_keterangan.isi_hamil, dbo.tc_pemeriksaan_dokter_v2.nama_pemeriksaan, dbo.tc_pemeriksaan_dokter_v2.hasil, dbo.tc_pemeriksaan_dokter_v2.ket_hasil, 
                      dbo.tc_pemeriksaan_dokter_v2.kode_pemeriksaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [view_tc_surat_keterangan]");
    }
};
