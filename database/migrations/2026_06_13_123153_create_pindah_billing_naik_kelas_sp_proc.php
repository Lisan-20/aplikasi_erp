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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[pindah_billing_naik_kelas_sp]

@no_registrasi as int,
@kode_kelompok_skrg as int,
@kode_klas_awal as int,
@kode_klas_skrg as int
AS

-- PASIEN BPJS

if (@kode_kelompok_skrg=8) or (@kode_kelompok_skrg=9) or (@kode_kelompok_skrg=10) or (@kode_kelompok_skrg=11) or (@kode_kelompok_skrg=12)
BEGIN

--untuk ke klas KLAS ISOLASI
	if (@kode_klas_skrg=2)
	BEGIN
	UPDATE mt_tarif_klas2_v
	SET rs_up=bill_rs_bpjs*jumlah, dr1_up=bill_dr1_bpjs*jumlah, dr2_up=bill_dr2_bpjs*jumlah, kode_klas_layan=2
	WHERE no_registrasi=@no_registrasi;

	END

--untuk ke klas VIP
	if (@kode_klas_skrg=4)
	BEGIN
	UPDATE mt_tarif_klas4_v
	SET rs_up=bill_rs_bpjs*jumlah, dr1_up=bill_dr1_bpjs*jumlah, dr2_up=bill_dr2_bpjs*jumlah, kode_klas_layan=4
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 1
	if (@kode_klas_skrg=5)
	BEGIN
	UPDATE mt_tarif_klas5_v
	SET rs_up=bill_rs_bpjs*jumlah, dr1_up=bill_dr1_bpjs*jumlah, dr2_up=bill_dr2_bpjs*jumlah, kode_klas_layan=5
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 2
	if (@kode_klas_skrg=6)
	BEGIN
	UPDATE mt_tarif_klas6_v
	SET rs_up=bill_rs_bpjs*jumlah, dr1_up=bill_dr1_bpjs*jumlah, dr2_up=bill_dr2_bpjs*jumlah, kode_klas_layan=6
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 3
	if (@kode_klas_skrg=7)
	BEGIN
	UPDATE mt_tarif_klas7_v
	SET rs_up=bill_rs_bpjs*jumlah, dr1_up=bill_dr1_bpjs*jumlah, dr2_up=bill_dr2_bpjs*jumlah, kode_klas_layan=7
	WHERE no_registrasi=@no_registrasi;

	END
	
END


-- PASIEN UMUM
if (@kode_kelompok_skrg=1)
BEGIN

--untuk ke klas KLAS ISOLASI
	if (@kode_klas_skrg=2)
	BEGIN
	UPDATE mt_tarif_klas2_v
	SET rs_up=bill_rs*jumlah, dr1_up=bill_dr1*jumlah, dr2_up=bill_dr2*jumlah, kode_klas_layan=2
	WHERE no_registrasi=@no_registrasi;

	END

--untuk ke klas VIP
	if (@kode_klas_skrg=4)
	BEGIN
	UPDATE mt_tarif_klas4_v
	SET rs_up=bill_rs*jumlah, dr1_up=bill_dr1*jumlah, dr2_up=bill_dr2*jumlah, kode_klas_layan=4
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 1
	if (@kode_klas_skrg=5)
	BEGIN
	UPDATE mt_tarif_klas5_v
	SET rs_up=bill_rs*jumlah, dr1_up=bill_dr1*jumlah, dr2_up=bill_dr2*jumlah, kode_klas_layan=5
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 2
	if (@kode_klas_skrg=6)
	BEGIN
	UPDATE mt_tarif_klas6_v
	SET rs_up=bill_rs*jumlah, dr1_up=bill_dr1*jumlah, dr2_up=bill_dr2*jumlah, kode_klas_layan=6
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 3
	if (@kode_klas_skrg=7)
	BEGIN
	UPDATE mt_tarif_klas7_v
	SET rs_up=bill_rs*jumlah, dr1_up=bill_dr1*jumlah, dr2_up=bill_dr2*jumlah, kode_klas_layan=7
	WHERE no_registrasi=@no_registrasi;

	END
	
END

-- PASIEN PT
if (@kode_kelompok_skrg=5)
BEGIN

--untuk ke klas KLAS ISOLASI
	if (@kode_klas_skrg=2)
	BEGIN
	UPDATE mt_tarif_klas2_v
	SET rs_up=bill_rs_pt*jumlah, dr1_up=bill_dr1_pt*jumlah, dr2_up=bill_dr2_pt*jumlah, kode_klas_layan=2
	WHERE no_registrasi=@no_registrasi;

	END

--untuk ke klas VIP
	if (@kode_klas_skrg=4)
	BEGIN
	UPDATE mt_tarif_klas4_v
	SET rs_up=bill_rs_pt*jumlah, dr1_up=bill_dr1_pt*jumlah, dr2_up=bill_dr2_pt*jumlah, kode_klas_layan=4
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 1
	if (@kode_klas_skrg=5)
	BEGIN
	UPDATE mt_tarif_klas5_v
	SET rs_up=bill_rs_pt*jumlah, dr1_up=bill_dr1_pt*jumlah, dr2_up=bill_dr2_pt*jumlah, kode_klas_layan=5
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 2
	if (@kode_klas_skrg=6)
	BEGIN
	UPDATE mt_tarif_klas6_v
	SET rs_up=bill_rs_pt*jumlah, dr1_up=bill_dr1_pt*jumlah, dr2_up=bill_dr2_pt*jumlah, kode_klas_layan=6
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 3
	if (@kode_klas_skrg=7)
	BEGIN
	UPDATE mt_tarif_klas7_v
	SET rs_up=bill_rs_pt*jumlah, dr1_up=bill_dr1_pt*jumlah, dr2_up=bill_dr2_pt*jumlah, kode_klas_layan=7
	WHERE no_registrasi=@no_registrasi;

	END
	
END


-- PASIEN ASURANSI
if (@kode_kelompok_skrg=3)
BEGIN

--untuk ke klas KLAS ISOLASI
	if (@kode_klas_skrg=2)
	BEGIN
	UPDATE mt_tarif_klas2_v
	SET rs_up=bill_rs_ass*jumlah, dr1_up=bill_dr1_ass*jumlah, dr2_up=bill_dr2_ass*jumlah, kode_klas_layan=2
	WHERE no_registrasi=@no_registrasi;

	END

--untuk ke klas VIP
	if (@kode_klas_skrg=4)
	BEGIN
	UPDATE mt_tarif_klas4_v
	SET rs_up=bill_rs_ass*jumlah, dr1_up=bill_dr1_ass*jumlah, dr2_up=bill_dr2_ass*jumlah, kode_klas_layan=4
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 1
	if (@kode_klas_skrg=5)
	BEGIN
	UPDATE mt_tarif_klas5_v
	SET rs_up=bill_rs_ass*jumlah, dr1_up=bill_dr1_ass*jumlah, dr2_up=bill_dr2_ass*jumlah, kode_klas_layan=5
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 2
	if (@kode_klas_skrg=6)
	BEGIN
	UPDATE mt_tarif_klas6_v
	SET rs_up=bill_rs_ass*jumlah, dr1_up=bill_dr1_ass*jumlah, dr2_up=bill_dr2_ass*jumlah, kode_klas_layan=6
	WHERE no_registrasi=@no_registrasi;

	END
	
--untuk ke klas KLAS 3
	if (@kode_klas_skrg=7)
	BEGIN
	UPDATE mt_tarif_klas7_v
	SET rs_up=bill_rs_ass*jumlah, dr1_up=bill_dr1_ass*jumlah, dr2_up=bill_dr2_ass*jumlah, kode_klas_layan=7
	WHERE no_registrasi=@no_registrasi;

	END
	
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pindah_billing_naik_kelas_sp");
    }
};
