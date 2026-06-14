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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[sp_lis_order_baru2]

 @kode_penunjang as varchar(20)
as

begin

INSERT INTO db_MedLis.dbo.order_lis2 (kode_penunjang, kode_tarif, kode_mt_hasilpm, nama_tindakan, nama_pemeriksaan, no_registrasi, no_mr, no_kunjungan, tgl_transaksi, kode_dokter1, kode_dokter2, kode_bagian, 
                      kode_kelompok, kode_perusahaan, jen_kelamin, status_daftar, catatan, waktu_sample, nama_pasien, tgl_lhr, nama_ruang, kode_ruang, jns_rawat, alamat)

SELECT kode_penunjang, kode_tarif, kode_mt_hasilpm, nama_tindakan, nama_pemeriksaan, no_registrasi, no_mr, no_kunjungan, tgl_transaksi, kode_dokter1, kode_dokter2, kode_bagian, 
                      kode_kelompok, kode_perusahaan, jen_kelamin, status_daftar, catatan, waktu_sample, nama_pasien, tgl_lhr, nama_ruang, kode_ruang, jns_rawat, alamat

FROM order_lis2 Where kode_penunjang=@kode_penunjang; 

update pm_tc_penunjang Set flag_lis=1 Where kode_penunjang=@kode_penunjang; 

end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_lis_order_baru2");
    }
};
