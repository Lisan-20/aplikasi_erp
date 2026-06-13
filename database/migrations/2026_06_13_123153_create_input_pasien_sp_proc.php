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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[input_pasien_sp]
as

declare
@kode_kelompok as int,
@kode_perusahaan as int

--set @kode_kelompok =(select kode_kelompok from mt_nasabah where )
--select * into mt_master_pasien_old from mt_master_pasien;
truncate table mt_master_pasien;

insert into mt_master_pasien 
( kota,no_mr,nama_pasien, nama_panggilan,nama_kel_pasien,  no_ktp, pekerjaan, tgl_lhr, tempat_lahir, almt_ttp_pasien,
tlp_almt_ttp, jen_kelamin, status_perkaw,kode_agama, kebangsaan, nama_kel_ter, 
 kode_pendidikan, kode_kelompok,kode_perusahaan, nama_almt_kantor, gol_darah, alergi,nik)

select kota,no_mr,nama_pasien, nama_panggilan,nama_kel_ter, no_ktp, pekerjaan, tgl_lhr, tempat_lahir, almt_ttp_pasien,
tlp_almt_ttp, jen_kelamin, status_perkaw,kode_agama, kebangsaan, nama_kel_ter,  
kode_pendidikan, '3' as kode_kelompok,cast(kode_perusahaan as int) as kode_perusahaan, nama_almt_kantor, gol_darah, alergi,nik
 from master_pasien_srv_v
 
 UPDATE mt_master_pasien set kode_kelompok=12 where kode_perusahaan='307';--BPJS NON PBI
 UPDATE update_kelompok_v set kode_kelompok=5;--update kelompok asuransi
 
 insert into mt_master_pasien 
( kota,no_mr,nama_pasien, nama_panggilan,nama_kel_pasien,  no_ktp, pekerjaan, tgl_lhr, tempat_lahir, almt_ttp_pasien,
tlp_almt_ttp, jen_kelamin, status_perkaw,kode_agama, kebangsaan, nama_kel_ter, 
 kode_pendidikan, kode_kelompok,kode_perusahaan, nama_almt_kantor, gol_darah, alergi,nik)

select kota,no_mr,nama_pasien, nama_panggilan,nama_kel_ter, no_ktp, pekerjaan, tgl_lhr, tempat_lahir, almt_ttp_pasien,
tlp_almt_ttp, jen_kelamin, status_perkaw,kode_agama, kebangsaan, nama_kel_ter,  
kode_pendidikan, '1' as kode_kelompok,'0' as kode_perusahaan, nama_almt_kantor, gol_darah, alergi,nik
 from master_pasien_umum_srv_v
 
 ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS input_pasien_sp");
    }
};
