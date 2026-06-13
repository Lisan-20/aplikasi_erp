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
        DB::unprepared("CREATE proc [dbo].[pindah_billing_umum_persh_sp]
@no_registrasi as int,
@kode_kelompok_awal as int,
@kode_kelompok_skrg as int
AS
--untuk pindah billing dari asuransi ke umum
-- untuk billing selain ruangan & obat
--untuk tarif non rujukan
UPDATE v_pindah_billing_umum_persh
SET bill_rs_trans=bill_rs*jumlah, bill_dr1_trans=bill_dr1*jumlah, bill_dr2_trans=bill_dr2*jumlah
WHERE no_registrasi=@no_registrasi;
--v_pindah_billing_umum_persh_rujukan
--untuk tarif rujukan
UPDATE v_pindah_billing_umum_persh_rujukan
SET bill_rs_jatah=bill_rs, bill_dr1=bill_dr1_jatah, bill_dr2=bill_dr2_jatah
WHERE no_registrasi=@no_registrasi;


--untuk billing obat ruangan & resep dri apotik
--UPDATE v_pindah_billing_obat
--SET bill_rs=bill_rs_jatah
--WHERE no_registrasi=@no_registrasi;

--untuk billing ruangan
UPDATE v_pindah_billing_ruangan
SET bill_rs=harga_r
WHERE no_registrasi=@no_registrasi;

UPDATE v_pindah_billing_ruangan_fix
SET bill_rs=harga_r * jumlah
WHERE no_registrasi=@no_registrasi;

--untuk tarif vk dan ok -- blm ok
--UPDATE v_pindah_billing_umum_persh_okvk SET bill_rs_trans=bill_rs_jatah, bill_dr1_trans=bill_dr1_jatah, bill_dr2_trans=bill_dr2_jatah WHERE no_registrasi=@no_registrasi;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pindah_billing_umum_persh_sp");
    }
};
