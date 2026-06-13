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
        DB::unprepared("CREATE proc [dbo].[revisi_kuitansi_pola_tarif_sp]
@no_registrasi as int,
@per_code as int,
@kode_kelompok_skrg as int
AS
--untuk pindah billing dari asuransi ke umum
-- untuk billing selain ruangan & obat
--untuk tarif non rujukan


--untuk ke pt/perusahaan
--if (@kode_kelompok_skrg=5)
--BEGIN
UPDATE revisi_kuitansi_pola_tarif_v
SET bill_rs_trans=bill_rs*jumlah, bill_dr1_trans=bill_dr1*jumlah
WHERE no_registrasi=@no_registrasi and code_ass=@per_code and code_nasabah=@kode_kelompok_skrg;

--untuk billing obat ruangan & resep dri apotik
--UPDATE v_pindah_billing_obat
--SET bill_rs=bill_rs_jatah
--WHERE no_registrasi=@no_registrasi;

--untuk billing ruangan
if (@per_code in (386))
BEGIN
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_kapitasi
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_kapitasi * jumlah
WHERE no_registrasi=@no_registrasi;
END

if (@per_code in (15))
BEGIN
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_inhealth
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_inhealth * jumlah
WHERE no_registrasi=@no_registrasi;
END

if (@per_code in (297))
BEGIN
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_hardlent
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_hardlent * jumlah
WHERE no_registrasi=@no_registrasi;
END

if (@per_code in (296))
BEGIN
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_cahaya
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_cahaya * jumlah
WHERE no_registrasi=@no_registrasi;
END

if (@per_code in (301))
BEGIN
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_nayaka
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_nayaka * jumlah
WHERE no_registrasi=@no_registrasi;
END

UPDATE v_billing_revisi_kuitansi
SET nk_perusahaan=billing_nk, bill=jml_billing
WHERE no_registrasi=@no_registrasi;

--untuk tarif vk dan ok -- blm ok
--UPDATE v_pindah_billing_umum_persh_okvk SET bill_rs_trans=bill_rs_jatah, bill_dr1_trans=bill_dr1_jatah, bill_dr2_trans=bill_dr2_jatah WHERE no_registrasi=@no_registrasi;
--END

--untuk ke Asuransi
/*if (@kode_kelompok_skrg=3)
BEGIN
UPDATE revisi_kuitansi_pola_tarif_v
SET bill_rs_trans=bill_rs*jumlah, bill_dr1_trans=bill_dr1*jumlah
WHERE no_registrasi=@no_registrasi and code_ass=@per_code and code_nasabah=@kode_kelompok_skrg;

--untuk billing obat ruangan & resep dri apotik
--UPDATE v_pindah_billing_obat
--SET bill_rs=bill_rs_jatah
--WHERE no_registrasi=@no_registrasi;

--untuk billing ruangan
if (@per_code in (386))
BEGIN
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_kapitasi
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_kapitasi * jumlah
WHERE no_registrasi=@no_registrasi;
END

if (@per_code in (15))
BEGIN
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_inhealth
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_inhealth * jumlah
WHERE no_registrasi=@no_registrasi;
END

if (@per_code in (297))
BEGIN
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_hardlent
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_hardlent * jumlah
WHERE no_registrasi=@no_registrasi;
END

if (@per_code in (296))
BEGIN
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_cahaya
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_cahaya * jumlah
WHERE no_registrasi=@no_registrasi;
END

if (@per_code in (301))
BEGIN
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_nayaka
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_nayaka * jumlah
WHERE no_registrasi=@no_registrasi;
END

UPDATE v_billing_revisi_kuitansi
SET nk_perusahaan=billing_nk, bill=jml_billing
WHERE no_registrasi=@no_registrasi;
--untuk tarif vk dan ok -- blm ok
--UPDATE v_pindah_billing_umum_persh_okvk SET bill_rs_trans=bill_rs_jatah, bill_dr1_trans=bill_dr1_jatah, bill_dr2_trans=bill_dr2_jatah WHERE no_registrasi=@no_registrasi;
END*/

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS revisi_kuitansi_pola_tarif_sp");
    }
};
