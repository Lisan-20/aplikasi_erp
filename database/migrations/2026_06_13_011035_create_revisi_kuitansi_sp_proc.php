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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[revisi_kuitansi_sp]
@no_registrasi as int,
@per_code as int,
@kode_kelompok_skrg as int
AS
--untuk pindah billing dari asuransi ke umum
-- untuk billing selain ruangan & obat
--untuk tarif non rujukan

--untuk ke umum
/*if (@kode_kelompok_skrg=1)
BEGIN
UPDATE revisi_kuitansi__v
SET bill_rs_trans=bill_rs*jumlah, bill_dr1_trans=bill_dr1*jumlah, bill_dr2_trans=bill_dr2*jumlah
WHERE no_registrasi=@no_registrasi;

--untuk billing obat ruangan & resep dri apotik
--UPDATE v_pindah_billing_obat
--SET bill_rs=bill_rs_jatah
--WHERE no_registrasi=@no_registrasi;

--untuk billing ruangan
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_r
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_r * jumlah
WHERE no_registrasi=@no_registrasi;

--untuk tarif vk dan ok -- blm ok
--UPDATE v_pindah_billing_umum_persh_okvk SET bill_rs_trans=bill_rs_jatah, bill_dr1_trans=bill_dr1_jatah, bill_dr2_trans=bill_dr2_jatah WHERE no_registrasi=@no_registrasi;

UPDATE v_billing_revisi_kuitansi
SET tunai=billing_nk, bill=jml_billing
WHERE no_registrasi=@no_registrasi;
END*/

--untuk ke pt/perusahaan
if (@kode_kelompok_skrg=5)
BEGIN
UPDATE revisi_kuitansi__v
SET bill_rs_trans=bill_rs_pt*jumlah, bill_dr1_trans=bill_dr1_pt*jumlah, bill_dr2_trans=bill_dr2_pt*jumlah
WHERE no_registrasi=@no_registrasi;

--untuk billing obat ruangan & resep dri apotik
--UPDATE v_pindah_billing_obat
--SET bill_rs=bill_rs_jatah
--WHERE no_registrasi=@no_registrasi;

--untuk billing ruangan
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_pt_ass
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_pt_ass * jumlah
WHERE no_registrasi=@no_registrasi;

UPDATE v_billing_revisi_kuitansi
SET nk_perusahaan=jml_billing
WHERE no_registrasi=@no_registrasi;

UPDATE v_billing_revisi_kuitansi
SET nk_perusahaan=billing_nk, bill=jml_billing
WHERE no_registrasi=@no_registrasi;

--untuk tarif vk dan ok -- blm ok
--UPDATE v_pindah_billing_umum_persh_okvk SET bill_rs_trans=bill_rs_jatah, bill_dr1_trans=bill_dr1_jatah, bill_dr2_trans=bill_dr2_jatah WHERE no_registrasi=@no_registrasi;
END

--untuk ke Asuransi
if (@kode_kelompok_skrg=3)
BEGIN
UPDATE revisi_kuitansi__v
SET bill_rs_trans=bill_rs_ass*jumlah, bill_dr1_trans=bill_dr1_ass*jumlah, bill_dr2_trans=bill_dr2_ass*jumlah
WHERE no_registrasi=@no_registrasi;

--untuk billing obat ruangan & resep dri apotik
--UPDATE v_pindah_billing_obat
--SET bill_rs=bill_rs_jatah
--WHERE no_registrasi=@no_registrasi;

--untuk billing ruangan
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_pt_ass
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_pt_ass * jumlah
WHERE no_registrasi=@no_registrasi;

UPDATE v_billing_revisi_kuitansi
SET nk_perusahaan=billing_nk, bill=jml_billing
WHERE no_registrasi=@no_registrasi;

--untuk tarif vk dan ok -- blm ok
--UPDATE v_pindah_billing_umum_persh_okvk SET bill_rs_trans=bill_rs_jatah, bill_dr1_trans=bill_dr1_jatah, bill_dr2_trans=bill_dr2_jatah WHERE no_registrasi=@no_registrasi;
END

--untuk ke BPJS
if (@kode_kelompok_skrg=8) or (@kode_kelompok_skrg=9) or (@kode_kelompok_skrg=10) or (@kode_kelompok_skrg=11)
BEGIN
UPDATE revisi_kuitansi__v
SET bill_rs_trans=bill_rs_bpjs*jumlah, bill_dr1_trans=bill_dr1_bpjs*jumlah, bill_dr2_trans=bill_dr2_bpjs*jumlah
WHERE no_registrasi=@no_registrasi;

--untuk billing obat ruangan & resep dri apotik
--UPDATE v_pindah_billing_obat
--SET bill_rs=bill_rs_jatah
--WHERE no_registrasi=@no_registrasi;

--untuk billing ruangan
UPDATE v_revisi_kuitansi_ruangan
SET bill_rs=harga_bpjs
WHERE no_registrasi=@no_registrasi;

UPDATE v_revisi_kuitansi_ruangan_fix
SET bill_rs=harga_bpjs * jumlah
WHERE no_registrasi=@no_registrasi;

UPDATE v_billing_revisi_kuitansi
SET nk_perusahaan=billing_nk, bill=jml_billing, nk_bpjs=billing_nk
WHERE no_registrasi=@no_registrasi;

--untuk tarif vk dan ok -- blm ok
--UPDATE v_pindah_billing_umum_persh_okvk SET bill_rs_trans=bill_rs_jatah, bill_dr1_trans=bill_dr1_jatah, bill_dr2_trans=bill_dr2_jatah WHERE no_registrasi=@no_registrasi;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS revisi_kuitansi_sp");
    }
};
