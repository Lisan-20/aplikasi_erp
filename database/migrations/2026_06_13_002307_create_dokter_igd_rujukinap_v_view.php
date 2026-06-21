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
        DB::statement("CREATE OR ALTER VIEW dbo.dokter_igd_rujukinap_v
AS
SELECT     dbo.dokter_igd_inap_v.tgl, dbo.dokter_igd_inap_v.bln, dbo.dokter_igd_inap_v.thn, dbo.dokter_igd_inap_v.no_kunjungan, dbo.dokter_igd_inap_v.kode_bagian_tujuan, 
                      dbo.dokter_igd_inap_v.no_registrasi, dbo.dokter_igd_inap_v.no_mr, dbo.dokter_igd_inap_v.kode_dokter, dbo.dokter_igd_inap_v.stat_pasien, 
                      dbo.dokter_igd_inap_v.status_batal, dbo.dokter_igd_inap_v.kode_kelompok, dbo.dokter_igd_inap_v.tgl_masuk, dbo.dokter_igd_inap_v.tgl_keluar, 
                      dbo.dokter_igd_inap_v.nama_pegawai, dbo.dokter_igd_inap_v.almt_ttp_pasien, dbo.dokter_igd_inap_v.tlp_almt_ttp
FROM         dbo.dokter_igd_inap_v INNER JOIN
                      dbo.registrasi_inap_v ON dbo.dokter_igd_inap_v.no_registrasi = dbo.registrasi_inap_v.no_registrasi
WHERE     (dbo.dokter_igd_inap_v.kode_bagian_tujuan = '020101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dokter_igd_rujukinap_v]");
    }
};
