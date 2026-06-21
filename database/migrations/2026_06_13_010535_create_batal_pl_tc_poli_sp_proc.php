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
CREATE OR ALTER PROCEDURE [dbo].[batal_pl_tc_poli_sp]
	

AS
insert into  pl_tc_poli_batal( id_pl_tc_poli, kode_poli, no_kunjungan, kode_bagian, no_antrian, tgl_jam_poli, kode_dokter, kode_resep, kode_gcu, status_periksa, no_induk, kode_jadwal, status_isihasil, status_bayar, 
                      datang, id_mt_jadwal_dokter, status_batal, jam_praktek, no_antrian_bpjs, no_antrian_umum, tgl_jam_panggil, tgl_jam_keluar, status_panggil, status_keluar

)
 select   id_pl_tc_poli, kode_poli, no_kunjungan, kode_bagian, no_antrian, tgl_jam_poli, kode_dokter, kode_resep, kode_gcu, status_periksa, no_induk, kode_jadwal, status_isihasil, status_bayar, 
                      datang, id_mt_jadwal_dokter, status_batal, jam_praktek, no_antrian_bpjs, no_antrian_umum, tgl_jam_panggil, tgl_jam_keluar, status_panggil, status_keluar
 
 from batal_pl_tc_poli_v


 ---- Hapus tc_registrasi
 delete pl_tc_poli where id_pl_tc_poli in (select id_pl_tc_poli from pl_tc_poli_batal)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batal_pl_tc_poli_sp");
    }
};
