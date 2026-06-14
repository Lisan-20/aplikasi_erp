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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_kaderbidan_v
AS
SELECT     dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.dc_asal_pasien.asal_pasien, dbo.dc_sub_asal_pasien.detail, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.mt_master_tarif.nama_tarif, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.nama_pasien, 
                      dbo.dc_sub_asal_pasien.id_dc_sub_asal_pasien, dbo.dc_sub_asal_pasien.id_dc_asal_pasien
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.dc_sub_asal_pasien ON dbo.tc_registrasi.id_dc_sub_asal_pasien = dbo.dc_sub_asal_pasien.id_dc_sub_asal_pasien INNER JOIN
                      dbo.dc_asal_pasien ON dbo.dc_sub_asal_pasien.id_dc_asal_pasien = dbo.dc_asal_pasien.id_dc_asal_pasien INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif
GROUP BY dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.dc_asal_pasien.asal_pasien, dbo.dc_sub_asal_pasien.detail, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.status_batal, 
                      dbo.dc_asal_pasien.id_dc_asal_pasien, dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_master_tarif.nama_tarif, dbo.tc_trans_kasir.no_kuitansi, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.nama_pasien, dbo.dc_sub_asal_pasien.id_dc_sub_asal_pasien, dbo.dc_sub_asal_pasien.id_dc_asal_pasien
HAVING      (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.dc_asal_pasien.id_dc_asal_pasien IN (13, 21)) AND 
                      (dbo.tc_trans_pelayanan.kode_bagian IN ('030901', '030501')) AND (dbo.tc_trans_pelayanan.kode_tarif > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_kaderbidan_v]");
    }
};
