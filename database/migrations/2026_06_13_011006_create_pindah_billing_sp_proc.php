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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[pindah_billing_sp]
@no_registrasi as int,
@kode_kelompok_awal as int,
@kode_kelompok_skrg as int
AS

--ke Asuaransi
--Yg diupdate bill_rs_jatah dll
IF (@kode_kelompok_awal<>3 AND @kode_kelompok_skrg=3)
BEGIN

UPDATE v_pindah_billing_pasien 
SET bill_rs_jatah_trans=bill_rs_ass * jumlah,bill_dr1_jatah_trans=bill_dr1_ass * jumlah,bill_dr2_jatah_trans=bill_dr2_ass * jumlah
WHERE no_registrasi=@no_registrasi;

--UPDATE v_pindah_billing_pasien_bedah 
--SET bill_rs_jatah_trans=bill_rs_mt,bill_dr1_jatah_trans=bill_dr1_mt,bill_dr2_jatah_trans=bill_dr2_mt
--WHERE no_registrasi=@no_registrasi and no_urut=1;

UPDATE tc_trans_pelayanan set bill_rs_jatah=bill_rs WHERE no_registrasi=@no_registrasi AND jenis_tindakan=11 AND (kode_tc_trans_kasir is NULL or kode_tc_trans_kasir=0);
END
----------------------------------------------------------------
--umum ke pt
IF (@kode_kelompok_awal<>5 AND @kode_kelompok_skrg=5)
BEGIN

UPDATE v_pindah_billing_pasien 
SET bill_rs_jatah_trans=bill_rs_pt * jumlah,bill_dr1_jatah_trans=bill_dr1_pt * jumlah,bill_dr2_jatah_trans=bill_dr2_pt * jumlah
WHERE no_registrasi=@no_registrasi;

--UPDATE v_pindah_billing_pasien_bedah 
--SET bill_rs_jatah_trans=bill_rs_mt,bill_dr1_jatah_trans=bill_dr1_mt,bill_dr2_jatah_trans=bill_dr2_mt, 
--	bill_rs_trans=0,bill_dr1_trans=0,bill_dr2_trans=0
--WHERE no_registrasi=@no_registrasi;

UPDATE tc_trans_pelayanan set bill_rs_jatah=bill_rs WHERE no_registrasi=@no_registrasi AND jenis_tindakan=11 AND (kode_tc_trans_kasir is NULL or kode_tc_trans_kasir=0);
END
----------------------------------------------------------
--umum ke bpjs/jamkesda
IF (@kode_kelompok_awal<>8 and @kode_kelompok_awal<>9 and @kode_kelompok_awal<>10 AND (@kode_kelompok_skrg=8 or @kode_kelompok_skrg=9 or @kode_kelompok_skrg=10))
BEGIN

UPDATE v_pindah_billing_pasien 
SET bill_rs_jatah_trans=bill_rs_pt * jumlah,bill_dr1_jatah_trans=bill_dr1_pt * jumlah,bill_dr2_jatah_trans=bill_dr2_pt * jumlah
WHERE no_registrasi=@no_registrasi;

--UPDATE v_pindah_billing_pasien_bedah 
--SET bill_rs_jatah_trans=bill_rs_mt,bill_dr1_jatah_trans=bill_dr1_mt,bill_dr2_jatah_trans=bill_dr2_mt, 
--	bill_rs_trans=0,bill_dr1_trans=0,bill_dr2_trans=0
--WHERE no_registrasi=@no_registrasi;

UPDATE tc_trans_pelayanan set bill_rs_jatah=bill_rs WHERE no_registrasi=@no_registrasi AND jenis_tindakan=11 AND (kode_tc_trans_kasir is NULL or kode_tc_trans_kasir=0);
END
----------------------------------------------------------
-- tarif bedah
IF (@kode_kelompok_awal=1 AND @kode_kelompok_skrg=3)
BEGIN 

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans * 0.25 * jumlah,bill_dr1_jatah_trans=total_trans * 0.75 * jumlah
WHERE no_registrasi=@no_registrasi AND (no_urut=1 or no_urut=2 or no_urut=6);

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans - 50000 ,bill_dr1_jatah_trans=50000
WHERE no_registrasi=@no_registrasi AND (no_urut=3) and status_penata=1;

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans * 0.5 * jumlah,bill_dr1_jatah_trans=total_trans * 0.5 * jumlah
WHERE no_registrasi=@no_registrasi AND (no_urut=3) and status_penata=2;

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans,bill_dr1_jatah_trans=0
WHERE no_registrasi=@no_registrasi AND (no_urut<>3) and no_urut<>1 and no_urut<>2 and no_urut<>6;

END
-------------------------------------------------------
IF (@kode_kelompok_awal=1 AND @kode_kelompok_skrg=5)
BEGIN 

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans * 0.2 * jumlah,bill_dr1_jatah_trans=total_trans * 0.8 * jumlah
WHERE no_registrasi=@no_registrasi AND (no_urut=1 or no_urut=2 or no_urut=6);

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans - 50000 ,bill_dr1_jatah_trans=50000
WHERE no_registrasi=@no_registrasi AND (no_urut=3) and status_penata=1;

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans * 0.5 * jumlah,bill_dr1_jatah_trans=total_trans * 0.5 * jumlah
WHERE no_registrasi=@no_registrasi AND (no_urut=3) and status_penata=2;

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans,bill_dr1_jatah_trans=0
WHERE no_registrasi=@no_registrasi AND (no_urut<>3) and no_urut<>1 and no_urut<>2 and no_urut<>6;
END
----------------------------------------------------------
IF (@kode_kelompok_awal=1 AND (@kode_kelompok_skrg=8 or @kode_kelompok_skrg=9 or @kode_kelompok_skrg=10))
BEGIN 

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans * 0.2 * jumlah,bill_dr1_jatah_trans=total_trans * 0.8 * jumlah
WHERE no_registrasi=@no_registrasi AND (no_urut=1 or no_urut=2 or no_urut=6);

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans - 50000 ,bill_dr1_jatah_trans=50000
WHERE no_registrasi=@no_registrasi AND (no_urut=3) and status_penata=1;

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans * 0.5 * jumlah,bill_dr1_jatah_trans=total_trans * 0.5 * jumlah
WHERE no_registrasi=@no_registrasi AND (no_urut=3) and status_penata=2;

UPDATE v_pindah_billing_pasien_bedah 
SET bill_rs_jatah_trans=total_trans,bill_dr1_jatah_trans=0
WHERE no_registrasi=@no_registrasi AND (no_urut<>3) and no_urut<>1 and no_urut<>2 and no_urut<>6;
END

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pindah_billing_sp");
    }
};
