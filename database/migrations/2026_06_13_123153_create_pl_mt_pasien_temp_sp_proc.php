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
        DB::unprepared("
CREATE OR ALTER PROCEDURE [dbo].[pl_mt_pasien_temp_sp]
	
AS
truncate table  pl_mt_pasien_temp

insert into pl_mt_pasien_temp (kode_poli, no_kunjungan, kode_bagian, no_antrian, tgl_jam_poli, kode_dokter, no_mr, nama_pasien, nama_poli, nama_dokter, no_registrasi, tgl_masuk, tgl_keluar, kode_bagian_poli, kode_kelompok, 
                         kode_perusahaan, no_induk_dokter, status_batal, no_induk,status_periksa, status_bayar,kode_jadwal,status_blpl,daftar_ol)

SELECT  kode_poli, no_kunjungan, kode_bagian, no_antrian, tgl_jam_poli, kode_dokter, no_mr, nama_pasien, nama_poli, nama_dokter, no_registrasi, tgl_masuk, tgl_keluar, kode_bagian_poli, kode_kelompok, 
                         kode_perusahaan, no_induk_dokter, status_batal, no_induk,status_periksa,status_bayar,kode_jadwal,status_blpl,daftar_ol

FROM  pl_mt_pasien_v ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pl_mt_pasien_temp_sp");
    }
};
